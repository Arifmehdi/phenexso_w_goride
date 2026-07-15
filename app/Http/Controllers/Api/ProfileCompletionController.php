<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Driver;
use App\Models\Corporate;

class ProfileCompletionController extends Controller
{
    /**
     * Determine which fields to use based on the model type.
     */
    private function getFieldsForModel($user): array
    {
        // Check the actual model class to determine available fields
        // Check model type using instanceof

        // Fields common to User models (used by solo, user roles)
        $userFields = [
            'father_name' => ['label' => 'Father Name', 'type' => 'text', 'section' => 'personal', 'required' => false],
            'dob' => ['label' => 'Date of Birth', 'type' => 'date', 'section' => 'personal', 'required' => true],
            'nid' => ['label' => 'NID Number', 'type' => 'text', 'section' => 'personal', 'required' => true],
            'address' => ['label' => 'Present Address', 'type' => 'textarea', 'section' => 'personal', 'required' => true],
            'blood_group' => ['label' => 'Blood Group', 'type' => 'select', 'options' => ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'], 'section' => 'personal', 'required' => false],
            'emergency_contact' => ['label' => 'Emergency Contact', 'type' => 'text', 'section' => 'personal', 'required' => true],
        ];

        $driverFields = [
            'license_no' => ['label' => 'Driving License Number', 'type' => 'text', 'section' => 'driver', 'required' => true],
            'address' => ['label' => 'Address', 'type' => 'textarea', 'section' => 'driver', 'required' => true],
            'nid' => ['label' => 'NID Number', 'type' => 'text', 'section' => 'driver', 'required' => true],
        ];

        $corporateFields = [
            'company_name' => ['label' => 'Company Name', 'type' => 'text', 'section' => 'company', 'required' => true],
            'address' => ['label' => 'Company Address', 'type' => 'textarea', 'section' => 'company', 'required' => true],
        ];

        // Return fields appropriate for the model type
        if ($user instanceof \App\Models\Driver) {
            return $driverFields;
        } elseif ($user instanceof \App\Models\Corporate) {
            return $corporateFields;
        } else {
            // Regular User model
            $role = $user->role ?? 'solo';
            $extraFields = [];
            if ($role === 'driver' || $role === 'owner') {
                $extraFields['license_no'] = ['label' => 'Driving License Number', 'type' => 'text', 'section' => 'driver', 'required' => true];
                $extraFields['vehicle_type'] = ['label' => 'Vehicle Type', 'type' => 'select', 'options' => ['car', 'motor', 'ambulance'], 'section' => 'driver', 'required' => true];
                $extraFields['tin_number'] = ['label' => 'TIN Number', 'type' => 'text', 'section' => 'documents', 'required' => false];
            }
            if ($role === 'corporate') {
                $extraFields['company_name'] = ['label' => 'Company Name', 'type' => 'text', 'section' => 'company', 'required' => true];
                $extraFields['tin_number'] = ['label' => 'TIN / Trade License', 'type' => 'text', 'section' => 'company', 'required' => true];
            }
            return array_merge($userFields, $extraFields);
        }
    }

    public function completion(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $allFields = $this->getFieldsForModel($user);
        $filledFields = [];
        $missingFields = [];

        foreach ($allFields as $field => $config) {
            // Only check fields that actually exist on the model
            if (!isset($user->{$field})) continue;
            
            $value = $user->{$field};
            $isFilled = $this->isFieldFilled($value);

            $fieldData = [
                'key' => $field,
                'label' => $config['label'],
                'type' => $config['type'] ?? 'text',
                'options' => $config['options'] ?? null,
                'placeholder' => $config['placeholder'] ?? '',
                'section' => $config['section'] ?? 'personal',
                'required' => $config['required'] ?? true,
                'filled' => $isFilled,
            ];

            if ($isFilled) {
                $fieldData['value'] = $value;
                $filledFields[] = $fieldData;
            } else {
                $missingFields[] = $fieldData;
            }
        }

        $totalFields = count($filledFields) + count($missingFields);
        $filledCount = count($filledFields);
        $percentage = $totalFields > 0 ? round(($filledCount / $totalFields) * 100) : 0;

        return response()->json([
            'success' => true,
            'profile_completion' => [
                'percentage' => $percentage,
                'filled_fields' => $filledFields,
                'missing_fields' => $missingFields,
                'total_fields' => $totalFields,
                'filled_count' => $filledCount,
            ],
            'user' => $user->toArray(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $allFields = $this->getFieldsForModel($user);
        $allowedFields = array_keys($allFields);

        $data = $request->all();
        $hasData = false;
        foreach ($data as $key => $value) {
            if (!empty($value) && in_array($key, $allowedFields)) {
                $hasData = true;
                break;
            }
        }

        if (!$hasData) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide at least one field to update'
            ], 422);
        }

        $updatedFields = [];
        foreach ($data as $key => $value) {
            if (in_array($key, $allowedFields) && !empty($value) && isset($user->{$key})) {
                $user->{$key} = $value;
                $updatedFields[] = $key;
            }
        }

        if (!empty($updatedFields)) {
            $user->save();
        }

        // Recalculate completion
        $completionResult = $this->recalculateCompletion($user);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'updated_fields' => $updatedFields,
            'profile_completion' => $completionResult,
            'user' => $user->fresh()->toArray(),
        ]);
    }

    private function recalculateCompletion($user): array
    {
        $allFields = $this->getFieldsForModel($user);
        $filledCount = 0;

        foreach ($allFields as $field => $config) {
            if (!isset($user->{$field})) continue;
            $value = $user->{$field};
            if ($this->isFieldFilled($value)) {
                $filledCount++;
            }
        }

        $totalFields = count($allFields);
        $percentage = $totalFields > 0 ? round(($filledCount / $totalFields) * 100) : 0;

        return ['percentage' => $percentage, 'filled_count' => $filledCount, 'total_fields' => $totalFields];
    }

    private function isFieldFilled($value): bool
    {
        if ($value === null) return false;
        if (is_string($value) && trim($value) === '') return false;
        return true;
    }
}
