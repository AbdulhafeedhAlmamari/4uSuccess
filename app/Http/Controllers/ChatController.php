<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Consultant;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Get messages between the current user and another user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages(Request $request)
    {
        $recipientId = $request->input('receiver_id');

        if (!$recipientId) {
            return response()->json(['error' => 'Recipient ID is required'], 400);
        }

        $currentUserId = Auth::id();

        // Get messages between the two users
        $messages = ChatMessage::where(function ($query) use ($currentUserId, $recipientId) {
            $query->where('sender_id', $currentUserId)
                ->where('receiver_id', $recipientId);
        })
            ->orWhere(function ($query) use ($currentUserId, $recipientId) {
                $query->where('sender_id', $recipientId)
                    ->where('receiver_id', $currentUserId);
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) {
                $sender = User::find($message->sender_id);
                return [
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_id' => $message->sender_id,
                    'sender_name' => $sender ? $sender->name : 'Unknown User',
                    'created_at' => $message->created_at
                ];
            });

        return response()->json([
            'success' => true,
            'messages' => $messages
        ]);
    }

    /**
     * Send a message to another user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'nullable',
            'message' => 'nullable|string'
        ]);
        // dd($request->all());
        $message = ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'message_id' => $message->id
        ]);
    }

    /**
     * Get consultant details for chat.
     *
     * @param  int  $consultantId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConsultantDetails($consultantId)
    {
        $consultant = User::where('id', $consultantId)
            ->where('role', 'consultant')
            ->first();

        if (!$consultant) {
            return response()->json(['error' => 'Consultant not found'], 404);
        }

        return response()->json([
            'success' => true,
            'consultant' => [
                'id' => $consultant->id,
                'name' => $consultant->name,
                'profile_image' => $consultant->profile_image
            ]
        ]);
    }
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
    private function getStudentContacts($consultantId)
    {
        // Step 1: Get all unique student IDs who chatted with the consultant
        $studentIds = ChatMessage::where('sender_id', $consultantId)
            ->orWhere('receiver_id', $consultantId)
            ->get(['sender_id', 'receiver_id'])
            ->map(function ($message) use ($consultantId) {
                return $message->sender_id == $consultantId ? $message->receiver_id : $message->sender_id;
            })
            ->unique()
            ->values();

        if ($studentIds->isEmpty()) {
            return collect(); // No students, return empty collection
        }

        // Step 2: Get all students with their student relationship
        $students = User::whereIn('id', $studentIds)
            ->whereHas('student') // Ensure the user is a student
            ->with('student')
            ->get();

        // Step 3: Prepare student data with last message and unread count
        $studentData = $students->map(function ($student) use ($consultantId) {
            // Get the last message between consultant and student
            $lastMessage = ChatMessage::where(function ($query) use ($consultantId, $student) {
                $query->where('sender_id', $consultantId)
                    ->where('receiver_id', $student->id);
            })
                ->orWhere(function ($query) use ($consultantId, $student) {
                    $query->where('sender_id', $student->id)
                        ->where('receiver_id', $consultantId);
                })
                ->orderBy('created_at', 'desc')
                ->first();

            // Get the count of unread messages sent by the student to the consultant
            $unreadCount = ChatMessage::where('sender_id', $student->id)
                ->where('receiver_id', $consultantId)
                ->where('is_read', false)
                ->count();

            // Attach data to student object
            $student->last_message = $lastMessage ? $lastMessage->message : null;
            $student->last_message_time = $lastMessage ? $lastMessage->created_at : null;
            $student->unread_count = $unreadCount;
            // $total_unread_count = ChatMessage::where('sender_id', $student->id)
            //     ->where('receiver_id', $consultantId)
            //     ->where('is_read', false)
            //     ->count();
            return $student;
        });

        // Step 4: Sort students by the time of the last message
        return $studentData->sortByDesc('last_message_time')->values();
    }
}
