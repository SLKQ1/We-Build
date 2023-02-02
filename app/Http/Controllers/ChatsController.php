<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Events\MessageSent;
use App\Models\Chat;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Chat $chat)
    {
        $messages = Message::where('chat_id', $chat->id)->with('user')->get();
        $chat = collect($chat)->put('messages', $messages);

        return Inertia::render('Chat/Index', ['user' => Auth::user(), 'chat' => $chat]);
    }

    public function create() 
    {

    }

    public function sendMessage(Chat $chat, Request $request)
    {
        $user = Auth::user();
        $message = $user->messages()->create([
            'chat_id' => $chat->id, 
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
