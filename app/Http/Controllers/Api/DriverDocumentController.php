<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DriverDocument;
use Illuminate\Http\Request;

class DriverDocumentController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'document_type' => 'required|in:nid_front,nid_back,license_front,license_back,vehicle_registration,selfie',
            'file'          => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $user = auth()->user();
        $path = $request->file('file')->store("driver-docs/{$user->id}", 'public');

        DriverDocument::updateOrCreate(
            ['user_id' => $user->id, 'document_type' => $request->document_type],
            ['file_path' => $path, 'status' => 'pending', 'rejection_reason' => null]
        );

        return response()->json([
            'success'  => true,
            'message'  => 'Document uploaded successfully. Awaiting admin review.',
            'file_url' => asset('storage/' . $path),
        ]);
    }

    public function myDocuments()
    {
        $docs = DriverDocument::where('user_id', auth()->id())->get();
        return response()->json(['success' => true, 'documents' => $docs]);
    }

    // Admin: review all pending documents
    public function pending()
    {
        $docs = DriverDocument::where('status', 'pending')
            ->with('user:id,name,email,mobile')
            ->latest()->paginate(20);
        return response()->json(['success' => true, 'documents' => $docs]);
    }

    // Admin: approve or reject a document
    public function review(Request $request, DriverDocument $document)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'reason' => 'required_if:status,rejected|nullable|string',
        ]);

        $document->update([
            'status'           => $request->status,
            'rejection_reason' => $request->reason,
        ]);

        // If all docs approved, auto-approve user
        if ($request->status === 'approved') {
            $allApproved = DriverDocument::where('user_id', $document->user_id)
                ->where('status', '!=', 'approved')->doesntExist();
            if ($allApproved) {
                \App\Models\User::where('id', $document->user_id)->update(['status' => 'active']);
            }
        }

        return response()->json(['success' => true]);
    }
}
