<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;

class MessageController extends Controller
{
    public function index($idReceiver)
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

    public function send($idUser)
    {
    }
}
