<?php

namespace App\Http\Controllers;

use App\Message;
use App\Http\Requests\CreateMessageRequest;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function show(Message $message)
    {
      return view('messages.show', [
    		'message' => $message,
    	]);
    }

    public function create(CreateMessageRequest $request)
    {

      $user = $request->user();

      $message = Message::create([
        'user_id' => $user->id,
        'content' => $request->input('message'),
        'image' => 'http://placeimg.com/600/338/any?t=15138676556'.mt_rand(0,100)
      ]);

      return redirect('/messages/'.$message->id);
    }
}
