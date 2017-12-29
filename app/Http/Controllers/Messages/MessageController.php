<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Product;
use App\Models\Message;
use App\Notifications\ReceivedMessage;

class MessageController extends Controller
{
    public function create($receiverId, $productId, $chain)   // chain = O -> new message  otherwise -> chain = chain_id and message is a reply to a previous message
    {
        $userId = Auth::id();
        if ($userId) {
            $sender = User::find($userId);
            $user = $sender;
            $senderProfile = $sender->profile;
            $profile = $senderProfile;
        }
        $receiver = User::find($receiverId);
        $product = Product::find($productId);
        if ($chain == 0) {   // New message
            $title = trans('rw_messaging.subject_1') . $product->title . ' (id: ' . $product->id . ')';
        } else {       // Reply Message
            $lastMessage = Message::latest('chain_id')->first();
            $title = $lastMessage->title;
        }
        if ($receiver->id == $userId) {  // No messages to your own !
            return back();
            ;
            //   return ->with('danger', __('rw_messaging.alert_message'));
        } elseif ($userId) {
            return view('messages.messageForm', compact('new', 'sender', 'senderProfile', 'receiver', 'profile', 'title', 'chain'));
        } else {
            return view('auth.login');
        }
    }

    public function send(Request $request, $idReceiver, $chain)  // send = Save Record !
    {
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
        // When send a message create 2 records in messages one for sender one for receiver each with own owner_id
        // So is it possible that each delete his own posts !
        $messageSender = new Message;
        $messageReceiver = new Message;

        // chain_id is used to group messages in conversations !
        // If new message chain = 0 and on save new chain_id is created
        if ($chain == 0) {
            $lastMessage = Message::latest('chain_id')->first();
            if ($lastMessage) {
                $lastChainId = $lastMessage->chain_id;
                $newChainId = $lastChainId + 1;
            } else {
                $newChainId = 1;  // Only by creating first email ever !
            }
            $messageSender->chain_id = $newChainId;
            $messageReceiver->chain_id = $newChainId;
        } else {
            $messageSender->chain_id = $chain;
            $messageReceiver->chain_id = $chain;
        }
        $messageSender->validated = 0;
        $messageReceiver->validated = 0;
        $messageSender->title = $request->title;
        $messageReceiver->title = $request->title;
        $messageReceiver->message = $request->message;
        $messageSender->message = $request->message;
        $messageSender->sender_id = $sender->id;
        $messageReceiver->sender_id = $sender->id;
        $messageSender->receiver_id = $receiver->id;
        $messageReceiver->receiver_id = $receiver->id;
        $messageSender->created_at = date('Y-m-d H:i:s');
        $messageReceiver->created_at = date('Y-m-d H:i:s');
        $messageSender->updated_at = date('Y-m-d H:i:s');
        $messageReceiver->updated_at = date('Y-m-d H:i:s');
        $messageSender->owner_id = $sender->id;
        $messageReceiver->owner_id = $receiver->id;
        $messageSender->unread = 0;
        $messageReceiver->unread = 1;
        $messageSender->save();
        $messageReceiver->save();
        // Notification
        $receiver->notify(new ReceivedMessage());
        //   session()->flash('msg', 'success');
        return redirect()->back()->withInput()->with('success', __('rw_profile.send'));
    }

    public function inboxList()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $messages = Message::where('owner_id', '=', "$userId")->where('receiver_id', '=', "$userId")->orderBy('id', 'DESC')->get();
        $sentBox = 0;

        return view('messages.messageList', compact('user', 'profile', 'messages', 'sentBox'));
    }

    public function sentBoxList()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $messages = Message::where('owner_id', '=', "$userId")->where('sender_id', '=', "$userId")->orderBy('id', 'DESC')->get();
        $sentBox = 1;

        return view('messages.messageList', compact('user', 'profile', 'messages', 'sentBox'));
    }

    public function conversationList($chainId)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $messages = Message::where('owner_id', '=', "$userId")->where('chain_id', '=', "$chainId")->orderBy('id', 'ASC')->get();

        return view('messages.conversationList', compact('user', 'profile', 'messages'));
    }

    public function view($messageId, $sentBox)
    {
        $new = 0;
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $message = Message::find($messageId);
        // Disable Notification and set message as Read
        if ($message->unread == 1) {
            if ($user->notifications()->where('type', 'App\Notifications\ReceivedMessage')->where('notifiable_id', $userId)->first()) {
                $user->notifications()->where('type', 'App\Notifications\ReceivedMessage')->where('notifiable_id', $userId)->first()->delete();
            }
            $message->unread = 0;
            $message->save();
        }
        if ($userId) {
            return view('messages.messageView', compact('new', 'sentBox', 'message', 'profile', 'userId'));
        } else {
            return view('auth.login');
        }
    }

    public function delete($messageId, $sentBox)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $message = Message::find($messageId);
        $message->delete();
        if ($sentBox == 0) {
            $messages = Message::where('owner_id', '=', "$userId")->where('receiver_id', '=', "$userId")->orderBy('id', 'DESC')->get();
        } else {
            $messages = Message::where('owner_id', '=', "$userId")->where('sender_id', '=', "$userId")->orderBy('id', 'DESC')->get();
        }

        // Nog verder uitwerken (RW)

        return view('messages.messageList', compact('user', 'profile', 'messages', 'sentBox'));
    }
}
