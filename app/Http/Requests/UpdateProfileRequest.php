<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // The authenticated entity may be a User, Driver, or Corporate —
        // each its own table with its own id space, so the unique-email
        // check must run against the CORRECT table (checking users.email
        // with a Driver's id would randomly pass/fail against whichever
        // unrelated User happens to share that id).
        $user  = $this->user();
        $table = $user->getTable();

        return [
            'name' => 'sometimes|required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'sometimes|required|string|email|max:255|unique:' . $table . ',email,' . $user->id,
            'father_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'bkash_number' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'blood_group' => 'nullable|string|max:5',
            'nid' => 'nullable|string|max:20',
            'short_bio' => 'nullable|string|max:1000',
            'mobile' => 'nullable|string|max:20',
            'emergency_contact_name'  => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'role' => 'nullable|string|max:255',
        ];
    }
}
