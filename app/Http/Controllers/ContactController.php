<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactConfirmation;

class ContactController extends Controller
{
    public function create()
    {
        return view('frontend.pages.contact');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'message' => 'required|string',
            'agree' => 'nullable',
        ]);

        $validatedData['agree'] = $request->has('agree') ? 1 : 0;
        // Save the contact first
        $contact = Contact::create($validatedData);

        // // Send email using the saved model
        // $this->sendAppointmentEmails($contact);

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function index()
    {
        menuSubmenu('contacts', 'contactListAll');
        $contacts = Contact::latest()->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return back()->with('success', 'Contact message deleted successfully!');
    }

    private function sendAppointmentEmails(Contact $contact)
    {
        // $emails = [
        //     // $validatedData->email, // User email
        //     // 'marketing@northbengaldairy.com', // Admin email
        // ];
        $adminEmail = 'marketing@northbengaldairy.com';
        Mail::to($adminEmail)->send(new ContactConfirmation($contact));

    }
}