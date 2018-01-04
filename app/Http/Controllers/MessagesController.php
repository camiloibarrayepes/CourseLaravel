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
      $image = $request->file('image');

      $message = Message::create([
        'user_id' => $user->id,
        'content' => $request->input('message'),
        'image' => $image->store('messages', 'public')
      ]);

      return redirect('/messages/'.$message->id);
    }

    public function search(Request $request)
    {
      $query = $request->input('query');

      //busco esta query en mesajes
      $messages = Message::search($query)->get();
      //le pedimos que carguen los usuarios
      $messages->load('user');

      return view('messages.index', [
        'messages' => $messages,
      ]);
    }
}
