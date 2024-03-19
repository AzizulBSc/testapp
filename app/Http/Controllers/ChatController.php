<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index()
    {
        $history = Chat::whereDate('created_at', Carbon::today())->get();
        return view('backend.pages.chat.index',compact('history'));
    }
    public function message(Request $request)
    {
        Chat::create([
            'sender_id' => auth()->user()->id,
            'username' => $request->username,
            'message' => $request->message,
        ]);
        event(new MessageEvent($request->username, $request->message, auth()->user()->id));
    }
}
