<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Consultant;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ChatController extends Controller
{
    /**
     * Get chat messages between authenticated user and another user
     */
    public function getMessages(Request $request)
    {
        $userId = Auth::id();
        $otherUserId = $request->user_id;
        // Fetch messages where current user is either sender or receiver
        $messages = ChatMessage::where(function ($query) use ($userId, $otherUserId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $otherUserId);
        })->orWhere(function ($query) use ($userId, $otherUserId) {
            $query->where('sender_id', $otherUserId)
                ->where('receiver_id', $userId);
        })
            ->with(['sender:id,name,profile_image'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark messages as read
        ChatMessage::where('sender_id', $otherUserId)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
        return response()->json([
            'messages' => $messages,
            'current_user_id' => $userId
        ]);
    }

    /**
     * Send a new message
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        $message = ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'is_read' => false
        ]);

        // Load the sender relationship
        $message->load('sender:id,name,profile_image');

        // Broadcast the message
        broadcast(new NewChatMessage($message))->toOthers();

        return response()->json($message);
    }

    /**
     * Get consultant details for chat
     */
    public function getConsultantDetails($consultantId)
    {
        $consultant = Consultant::with('user:id,name,profile_image')->findOrFail($consultantId);
        return response()->json([
            'consultant' => [
                'user' => [
                    'name' => $consultant->user->name,
                    'profile_image' => asset($consultant->user->profile_image),
                ],
            ],
            'user_id' => [
                $consultant->user->id,
            ]
        ]);
    }

    /**
     * Generate authentication signature for Pusher
     */
    public function auth(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response('Forbidden', 403);
        }

        $channelName = $request->input('channel_name');
        $socketId = $request->input('socket_id');

        // Extract user IDs from channel name (format: private-chat.1.2)
        $channelParts = explode('.', str_replace('private-chat.', '', $channelName));

        if (count($channelParts) !== 2) {
            return response('Forbidden', 403);
        }

        $user1 = (int)$channelParts[0];
        $user2 = (int)$channelParts[1];

        // Check if current user is one of the participants
        if ($user->id !== $user1 && $user->id !== $user2) {
            return response('Forbidden', 403);
        }

        // Create Pusher instance
        $pusher = new \Pusher\Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            config('broadcasting.connections.pusher.options')
        );

        // Generate auth signature
        $auth = $pusher->socket_auth($channelName, $socketId);

        return response($auth);
    }

    /**
     * Display the consultant chat interface.
     *
     * @return \Illuminate\View\View
     */
    //     public function consultantChat()
    //     {
    //         // Ensure the user is a consultant
    //         $user = Auth::user();
    //         $consultant = Consultant::where('user_id', $user->id)->first();

    //         if (!$consultant) {
    //             return redirect()->route('home')->with('error', 'Only consultants can access this page');
    //         }

    //         // Get all students who have chatted with this consultant
    //         $students = $this->getStudentContacts($user->id);

    //         return view('consultant.chat', [
    //             'consultant' => $consultant,
    //             'students' => $students
    //         ]);
    //     }

    //     /**
    //      * Get all students who have chatted with this consultant.
    //      *
    //      * @param int $consultantId
    //      * @return \Illuminate\Database\Eloquent\Collection
    //      */
    //     private function getStudentContacts($consultantId)
    //     {
    //         // Get all unique student IDs from chat messages
    //         $studentIds = DB::table('chat_messages')
    //             ->where('sender_id', $consultantId)
    //             ->orWhere('receiver_id', $consultantId)
    //             ->get(['sender_id', 'receiver_id'])
    //             ->map(function ($message) use ($consultantId) {
    //                 return $message->sender_id == $consultantId ? $message->receiver_id : $message->sender_id;
    //             })
    //             ->unique()
    //             ->values();

    //         // Get student users with their last message
    //         $students = User::whereIn('id', $studentIds)
    //             ->whereHas('student') // Ensure they are students
    //             ->with('student')
    //             ->get()
    //             ->map(function ($user) use ($consultantId) {
    //                 // Get the last message between this student and consultant
    //                 $lastMessage = DB::table('chat_messages')
    //                     ->where(function ($query) use ($consultantId, $user) {
    //                         $query->where('sender_id', $consultantId)
    //                             ->where('receiver_id', $user->id);
    //                     })
    //                     ->orWhere(function ($query) use ($consultantId, $user) {
    //                         $query->where('sender_id', $user->id)
    //                             ->where('receiver_id', $consultantId);
    //                     })
    //                     ->orderBy('created_at', 'desc')
    //                     ->first();

    //                 // Get unread message count
    //                 $unreadCount = DB::table('chat_messages')
    //                     ->where('sender_id', $user->id)
    //                     ->where('receiver_id', $consultantId)
    //                     ->where('is_read', false)
    //                     ->count();

    //                 $user->last_message = $lastMessage ? $lastMessage->message : null;
    //                 $user->last_message_time = $lastMessage ? $lastMessage->created_at : null;
    //                 $user->unread_count = $unreadCount;

    //                 return $user;
    //             })
    //             ->sortByDesc('last_message_time');

    //         return $students;
    //     }


    public function consultantChat()
    {
        // Ensure the user is a consultant
        $user = Auth::user();
        $consultant = Consultant::where('user_id', $user->id)->first();

        if (!$consultant) {
            return redirect()->route('home')->with('error', 'Only consultants can access this page');
        }

        // Get all students who have chatted with this consultant
        $students = $this->getStudentContacts($consultant->user_id);

        return view('consultant.chat', [
            'consultant' => $consultant,
            'students' => $students
        ]);
    }

    /**
     * Get all students who have chatted with this consultant.
     *
     * @param int $consultantId
     * @return \Illuminate\Support\Collection
     */
    /**
     * Get all students who have chatted with this consultant.
     *
     * @param int $consultantId
     * @return \Illuminate\Support\Collection
     */
    private function getStudentContacts($consultantId)
    {
        // Fetch all unique student IDs from chat messages
        $studentIds = ChatMessage::where(function ($query) use ($consultantId) {
            $query->where('sender_id', $consultantId)
                ->orWhere('receiver_id', $consultantId);
        })
            ->get(['sender_id', 'receiver_id']) // Get both sender and receiver IDs
            ->map(function ($message) use ($consultantId) {
                // Determine the other party in the chat
                return $message->sender_id == $consultantId ? $message->receiver_id : $message->sender_id;
            })
            ->unique() // Ensure uniqueness
            ->values(); // Reset the keys

        // Fetch student details
        $students = User::whereIn('id', $studentIds)->get();
        // dd($students);
        return $students;
    }
}
