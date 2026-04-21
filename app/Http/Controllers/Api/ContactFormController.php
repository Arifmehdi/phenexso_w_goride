<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact; // Import the Contact model
use App\Http\Requests\StoreContactRequest; // Import the StoreContactRequest
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    /**
     * Store a newly created contact form submission in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create($request->validated());
        // Optionally, you can send an email notification here
        // Mail::to('support@example.com')->send(new ContactFormMail($contact));

        return response()->json(['message' => 'Contact form submitted successfully!', 'data' => $contact], 201);
    }
}
