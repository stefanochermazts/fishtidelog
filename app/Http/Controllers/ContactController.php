<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show the contact form
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Store a new contact message
     */
    public function store(ContactRequest $request)
    {
        try {
            // Create the contact record
            $contact = Contact::create($request->validated());

            // Send email notification
            $notificationEmail = config('mail.contact_notification_email', env('CONTACT_NOTIFICATION_EMAIL'));
            
            if ($notificationEmail) {
                Mail::to($notificationEmail)->send(new ContactNotification($contact));
            }

            return redirect()->back()->with('success', __('contact_sent_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => __('contact_sent_error')]);
        }
    }
}
