<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $users = User::all();
            return view('admin.konsultasi', compact('users'));
        } elseif (Auth::guard('web')->check()) {
            $admins = Admin::all();
            return view('user.konsultasi', compact('admins'));
        } else {
            return redirect('/login');
        }
    }

    public function fetchMessages($userId, Request $request)
{
    $receiverType = $request->query('type');
    $auth = $this->getAuthenticatedUser();

    if (!$auth) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $authId = $auth['id'];
    $authType = $auth['type']; // <== App\Models\Admin atau App\Models\User

    $messages = Message::where(function ($query) use ($authId, $authType, $userId, $receiverType) {
        $query->where('sender_id', $authId)
              ->where('sender_type', $authType)
              ->where('receiver_id', $userId)
              ->where('receiver_type', $receiverType);
    })->orWhere(function ($query) use ($authId, $authType, $userId, $receiverType) {
        $query->where('receiver_id', $authId)
              ->where('receiver_type', $authType)
              ->where('sender_id', $userId)
              ->where('sender_type', $receiverType);
    })->orderBy('created_at')->get();

    return response()->json($messages);
}


    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|integer',
            'receiver_type' => 'required|string',
            'message' => 'required|string',
        ]);

        $auth = $this->getAuthenticatedUser();
        if (!$auth) return response()->json(['error' => 'Unauthorized'], 401);

        $message = Message::create([
            'sender_id' => $auth['id'],
            'sender_type' => $auth['type'],
            'receiver_id' => $request->receiver_id,
            'receiver_type' => $request->receiver_type,
            'message' => $request->message,
        ]);

        return response()->json($message);
    }

    private function getAuthenticatedUser()
    {
        if (Auth::guard('admin')->check()) {
            return [
                'id' => Auth::guard('admin')->id(),
                'type' => \App\Models\Admin::class,
                'role' => 'admin',
            ];
        } elseif (Auth::guard('web')->check()) {
            return [
                'id' => Auth::id(),
                'type' => \App\Models\User::class,
                'role' => 'user',
            ];
        }
        return null;
    }
}
