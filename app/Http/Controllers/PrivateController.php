<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notif;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class PrivateController extends Controller
{
    public function send_private(Request $request)
    {
        // dd($request->recipient, $request->notif);
        $notification = new Notif;
        $notification->notif = $request['recipient'];
        $notification->message = $request['notif'];
        $notif = $request->recipient;

        $message = new Message;
        $message->from = $request['recipient'];
        $id = $message->from;
        $message->message = $notif;
        $message->save();

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = [
            'to' => $id,
            'message' => $request['notif']
        ];
        $pusher->trigger('user.' . $request['recipient'], 'PrivateEvent', $data);

        if ($notification->save()) {
            return response()->json(['status' => true, 'message' => 'Message Added Succesfully']);
        }
    }
}
