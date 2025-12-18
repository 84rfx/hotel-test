<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'department' => 'required|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'subject' => $request->subject,
            'message' => $request->message,
            'read' => false,
        ]);

        // Send email notification to admin
        Mail::raw("New message received from {$message->name} ({$message->email}):\n\nSubject: {$message->subject}\nDepartment: {$message->department}\nPhone: {$message->phone}\n\nMessage:\n{$message->message}", function ($mail) use ($message) {
            $mail->to('admin@grandbandung.com')->subject('New Message Received: ' . $message->subject);
        });

        return redirect()->back()->with('success', 'Pesan Anda telah dikirim. Kami akan segera menghubungi Anda.');
    }
}
