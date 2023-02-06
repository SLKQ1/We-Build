<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Events\MessageSent;
use App\Models\Application;
use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    }

    public function show(Chat $chat)
    {
        $messages = Message::where('chat_id', $chat->id)->with('user')->get();
        $chat = collect($chat)->put('messages', $messages);

        return Inertia::render('Chat/Index', ['user' => Auth::user(), 'chat' => $chat]);
    }

    public function create(Request $request)
    {
        $application = Application::where('id', $request->input('application'))->with('project', 'user')->firstOrFail();
        return Inertia::render('Chat/Create', ['application' => $application]); 
    }

    public function store(Request $request)
    {
        Log::info('in store', [$request->all()]); 
        // Log::info('application', [$application]); 
        $application = Application::where('id', $request->input('application'))->firstOrFail();
        try {
            $chat = DB::transaction(function () use ($request, $application) {
                $user = Auth::user();

                $chatName = "{$user->name}/{$application->user->name}";

                // creating chat 
                $chat = Chat::create([
                    'name' => $chatName
                ]);

                // creating chat users 
                ChatUser::create([
                    'user_id' => Auth::user()->id,
                    'chat_id' => $chat->id,
                ]);

                ChatUser::create([
                    'user_id' => $application->user->id,
                    'chat_id' => $chat->id,
                ]);

                return $chat;
            });
            return Redirect::route('chat.show', ["chat" => $chat->id])->with('message', 'Chat created successfully');
        } catch (\Exception $exception) {
            return Redirect::route('projects.applications.show', ["application" => $application, "project" => $application->project])->with('error', "Unable to create chat.");
        }
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
