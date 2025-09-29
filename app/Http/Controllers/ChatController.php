<?php

namespace App\Http\Controllers;


use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ChatController extends Controller
{
    /**
     * Show the chat index page
     */
    public function index(): View
    {
        $users = User::where('id', '!=', auth()->id())
            ->orderBy('name')
            ->get();

        $user = auth()->user();

        // Get conversations where user is user1
        $conversationsAsUser1 = Conversation::where('user1_id', $user->id)
            ->with([
                'user2',
                'messages' => function ($query) {
                    $query->latest()->take(1);
                }
            ])
            ->get();

        // Get conversations where user is user2
        $conversationsAsUser2 = Conversation::where('user2_id', $user->id)
            ->with([
                'user1',
                'messages' => function ($query) {
                    $query->latest()->take(1);
                }
            ])
            ->get();

        $conversations = $conversationsAsUser1->merge($conversationsAsUser2)
            ->sortByDesc('last_message_at')
            ->take(10);

        return view('chat.index', compact('users', 'conversations'));
    }

    /**
     * Show a specific conversation
     */
    public function show(int $conversationId): View
    {
        $conversation = Conversation::with(['messages.sender', 'user1', 'user2'])
            ->findOrFail($conversationId);

        if (!$conversation->hasUser(auth()->id())) {
            abort(403, 'Access denied.');
        }

        $otherUser = $conversation->getOtherUser(auth()->id());
        $messages = $conversation->messages()->with('sender')->orderBy('created_at')->get();

        return view('chat.conversation', compact('conversation', 'otherUser', 'messages'));
    }

    /**
     * Start a new conversation with a user
     */
    public function startConversation(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $otherUserId = $request->user_id;

        if ($otherUserId == auth()->id()) {
            return response()->json(['error' => 'Cannot start conversation with yourself.'], 400);
        }

        $conversation = Conversation::getOrCreate(auth()->id(), $otherUserId);

        return response()->json([
            'conversation_id' => $conversation->id,
            'redirect_url' => route('chat.conversation', $conversation->id)
        ]);
    }

    /**
     * Send a message
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'content' => 'required|string|max:1000'
        ]);

        $conversation = Conversation::findOrFail($request->conversation_id);

        if (!$conversation->hasUser(auth()->id())) {
            return response()->json(['error' => 'Access denied.'], 403);
        }

        $message = $conversation->messages()->create([
            'sender_id' => auth()->id(),
            'content' => $request->input('content')
        ]);

        // Update conversation's last message
        $conversation->update([
            'last_message' => $request->input('content'),
            'last_message_at' => now()
        ]);

        $message->load('sender');

        // 通知を送信
        $recipient = $conversation->getOtherUser(auth()->id());
        if ($recipient) {
            NotificationService::sendChatMessageNotification($recipient, auth()->user(), $conversation);
        }

        return response()->json([
            'message' => $message,
            'formatted_time' => $message->formatted_time,
            'sender_name' => $message->sender->name
        ]);
    }

    /**
     * Get messages for a conversation
     */
    public function getMessages(Request $request, int $conversationId): JsonResponse
    {
        $conversation = Conversation::findOrFail($conversationId);

        if (!$conversation->hasUser(auth()->id())) {
            return response()->json(['error' => 'Access denied.'], 403);
        }

        $query = $conversation->messages()->with('sender');

        // If 'after' parameter is provided, only get messages after that ID
        if ($request->has('after') && is_numeric($request->after)) {
            $query->where('id', '>', $request->after);
        }

        $messages = $query->orderBy('created_at')->get();

        return response()->json($messages);
    }

    /**
     * Get user's conversations
     */
    public function getConversations(): JsonResponse
    {
        $user = auth()->user();

        // Get conversations where user is user1
        $conversationsAsUser1 = Conversation::where('user1_id', $user->id)
            ->with([
                'user2',
                'messages' => function ($query) {
                    $query->latest()->take(1);
                }
            ])
            ->get();

        // Get conversations where user is user2
        $conversationsAsUser2 = Conversation::where('user2_id', $user->id)
            ->with([
                'user1',
                'messages' => function ($query) {
                    $query->latest()->take(1);
                }
            ])
            ->get();

        $conversations = $conversationsAsUser1->merge($conversationsAsUser2)
            ->sortByDesc('last_message_at')
            ->values();

        return response()->json($conversations);
    }


}
