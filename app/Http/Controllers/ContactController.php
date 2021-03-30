<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function AdminContact()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function AdminAddContact()
    {
        return view('admin.contact.create');
    }

    public function AdminStoreContact(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|unique:contacts|min:3',
            'email' => 'required',
            'phone' => 'required',
        ],
            [
                'title.required' => 'Please Input Address',
                'title.min' => 'Address Longer Then 4 Char',
                'email.required' => 'Please Input Email',
                'phone.required' => 'Please Input Phone',
            ]);

        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('admin.contact')->with('success', 'Contact Insert Successfull');
    }

    public function AdminEditContact($id)
    {
        $contact = Contact::find($id);

        return view('admin.contact.edit', compact('contact'));
    }

    public function AdminDeleteContact($id)
    {
        Contact::find($id)->delete();

        return Redirect()->back()->with('success', 'Contact Delete Successfull');
    }

    public function AdminUpdateContact(Request $request, $id)
    {
        $validated = $request->validate([
            'address' => 'required|unique:contacts|min:3',
            'email' => 'required',
            'phone' => 'required',
        ],
        [
            'title.required' => 'Please Input Address',
            'title.min' => 'Address Longer Then 4 Char',
            'email.required' => 'Please Input Email',
            'phone.required' => 'Please Input Phone',
        ]);

        Contact::find($id)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return Redirect()->route('admin.contact')->with('success', 'Contact Update Successfull');
    }

    public function Contact()
    {
        $contacts = Contact::first();
        return view('pages.contact', compact('contacts'));
    }

    public function ContactForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:contact_forms|min:3',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ],
        [
            'name.required' => 'Please Input Address',
            'name.min' => 'Address Longer Then 4 Char',
            'email.required' => 'Please Input Email',
            'subject.required' => 'Please Input Phone',
            'message.required' => 'Please Input Phone',
        ]);

        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('contact')->with('success', 'Your Message Sent Successfull');
    }

    public function AdminContactMessages()
    {
        $messages = ContactForm::all();
        return view('admin.contact.messages', compact('messages'));
    }

    public function AdminDeleteContactMessages($id)
    {
        ContactForm::find($id)->delete();
        return Redirect()->route('admin.contact.message')->with('success', 'Contact Message Delete Successfull');
    }
}
