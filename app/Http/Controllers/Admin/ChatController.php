<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::whereHas('messages')->withCount(['messages as unread_count' => function ($q) {
            $q->where('is_from_admin', false)->where('is_read', false);
        }])->orderBy('unread_count', 'desc')->get();

        $recent = Message::where('is_from_admin', false)
            ->where('is_read', false)
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.chat.index', compact('users', 'recent'));
    }

    public function conversation(User $user)
    {
        $messages = Message::with('admin:id,name')
            ->forUser($user->id)
            ->latest()
            ->take(100)
            ->get()
            ->reverse()
            ->values();

        Message::forUser($user->id)
            ->where('is_from_admin', false)
            ->update(['is_read' => true]);

        return view('admin.chat.conversation', compact('user', 'messages'));
    }

    public function reply(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'user_id' => $user->id,
            'admin_id' => auth()->id(),
            'message' => $request->message,
            'is_from_admin' => true,
            'is_read' => true,
        ]);

        return redirect()->route('admin.chat.conversation', $user)
            ->with('success', 'Reply sent to ' . $user->name);
    }

    public function fetchMessages(User $user)
    {
        $messages = Message::with('admin:id,name')
            ->forUser($user->id)
            ->latest()
            ->take(100)
            ->get()
            ->reverse()
            ->values();

        return response()->json($messages);
    }

    public function sendReply(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $msg = Message::create([
            'user_id' => $user->id,
            'admin_id' => auth()->id(),
            'message' => $request->message,
            'is_from_admin' => true,
            'is_read' => true,
        ]);

        return response()->json($msg->load('admin:id,name'), 201);
    }
}
