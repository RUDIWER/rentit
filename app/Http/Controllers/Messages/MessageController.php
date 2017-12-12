<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Message;

class MessageController extends Controller
{
    public function create($idReceiver)
    {
        $userId = Auth::id();
        if ($userId) {
            $sender = User::find($userId);
            $user = $sender;
            $senderProfile = $sender->profile;
            $profile = $senderProfile;
        }

        $receiver = User::find($idReceiver);
        $receiverProfile = $receiver->profile;

        if ($userId) {
            return view('messages.contactForm', compact('sender', 'senderProfile', 'receiver', 'receiverProfile', 'profile'));
        }
    }

    public function send(Request $request, $idReceiver)
    {
        //dd($request);
        $this->validate(request(), [
            'message' => 'required|max:500',
        ]);
        $userId = Auth::id();
        if ($userId) {
            $sender = User::find($userId);
            $user = $sender;
            $senderProfile = $sender->profile;
            $profile = $senderProfile;
        }

        $receiver = User::find($idReceiver);
        $receiverProfile = $receiver->profile;

        $message = new Message;
        $message->validated = 0;
        $message->unread = 1;
        $message->message = $request->message;
        $message->message_description = 'Boodschap titel';
        $message->sender_id = $sender->id;
        $message->receiver_id = $receiver->id;
        $message->created_at = date('Y-m-d H:i:s');
        $message->updated_at = date('Y-m-d H:i:s');
        $message->save();

        session()->flash('msg', 'success');
        return redirect()->back()->withInput();
    }
}
