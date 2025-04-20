<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the contacts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboards.admin.contact', compact('contacts'));
    }

    /**
     * Show the form for creating a new contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.form');
    }

    /**
     * Store a newly created contact in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            // 'message_type' => 'required|string|max:255',
        ]);
        if (Auth::check()) {
            $validated['message_type'] = Auth::user()->role;
        } else {
            $validated['message_type'] = 'visitor';
        }
        Contact::create($validated);

        return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.');
    }

    /**
     * Reply to a contact message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request, $id)
    {
        $validated = $request->validate([
            'reply' => 'required|string',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->reply = $validated['reply'];
        $contact->save();

        // Here you could also add code to send an email with the reply

        return redirect()->back()->with('success', 'تم إرسال الرد بنجاح.');
    }

    /**
     * Remove the specified contact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'تم حذف الرسالة بنجاح.');
    }
    public function filter(Request $request)
    {
        $messageType = $request->input('message_type');
        
        $query = Contact::orderBy('created_at', 'desc');
        
        if ($messageType && $messageType != 'All') {
            $query->where('message_type', $messageType);
        }
        
        $contacts = $query->paginate(10);
        
        return response()->json([
            'html' => view('dashboards.admin.partials.contacts-table', compact('contacts'))->render(),
        ]);
    }
}