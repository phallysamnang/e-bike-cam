<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function messages(Request $request)
    {
        $messages = Message::forUser(auth()->id())
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values();

        Message::forUser(auth()->id())
            ->where('is_from_admin', true)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json($messages->load('admin:id,name'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'is_from_admin' => false,
        ]);

        return response()->json($message, 201);
    }

    public function unreadCount()
    {
        $count = Message::forUser(auth()->id())
            ->where('is_from_admin', true)
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }
}
