<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Product;
use App\Models\MessageHeader;
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
        $receiverProfile = $receiver->profile;

        $product = Product::find($productId);

        $title = trans('rw_messaging.subject_1') . $product->title . ' (id: ' . $product->id . ')';

        if ($userId) {
            return view('messages.messageForm', compact('sender', 'senderProfile', 'receiver', 'receiverProfile', 'profile', 'title', 'chain'));
        }
    }

    public function send(Request $request, $idReceiver, $chain)  // send = Save Record !
    {
        //dd($new);
        $this->validate(request(), [
            'message' => 'required|max:500',
            'title' => 'required|max:100'
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

        // chain_id is used to group messages in conversations !
        // If new message chain = 0 and on save new chain_id is created
        // If new Chain also messageHeader is created as to pof a new chain of messages
        if ($chain == 0) {
            $lastMessage = Message::latest('chain_id')->first();
            if ($lastMessage) {
                $lastChainId = $lastMessage->chain_id;
                $newChainId = $lastChainId + 1;
            } else {
                $newChainId = 1;
            }
            $message->chain_id = $newChainId;
            //create new messageHeader
            $messageHeader = new MessageHeader;
            $messageHeader->chain_id = $newChainId;
            $messageHeader->validated = 0;
            $messageHeader->unread = 1;
            $messageHeader->title = $request->title;
            $messageHeader->sender_id = $sender->id;
            $messageHeader->receiver_id = $receiver->id;
            $messageHeader->created_at = date('Y-m-d H:i:s');
            $messageHeader->updated_at = date('Y-m-d H:i:s');
            $messageHeader->save();
        } else {
            // existing message chain_id = chain from previous message
            $messageHeader = MessageHeader::where('chain_id', '=', "$chain")->first();
            $messageHeader->updated_at = date('Y-m-d H:i:s');
            $messageHeader->unread = 1;
            $messageHeader->save();
            $message->chain_id = $chain;
        }
        $message->validated = 0;
        $message->unread = 1;
        $message->message = $request->message;
        $message->title = $request->title;
        $message->sender_id = $sender->id;
        $message->receiver_id = $receiver->id;
        $message->created_at = date('Y-m-d H:i:s');
        $message->updated_at = date('Y-m-d H:i:s');
        $message->save();
        // Notification
        $receiver->notify(new ReceivedMessage());

        session()->flash('msg', 'success');
        return redirect()->back()->withInput();
    }

    public function messageHeaderTable()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $profile = $user->profile;
        $messageHeaders = MessageHeader::where('sender_id', '=', "$userId")
                            ->orWhere('receiver_id', '=', "$userId")
                            ->orderBy('updated_at', 'DESC')
                            ->get();
        return view('messages.messageHeaderTable', compact('user', 'profile', 'messageHeaders'));
    }
}
