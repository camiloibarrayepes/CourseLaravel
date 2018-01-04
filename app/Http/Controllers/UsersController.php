<?php

namespace App\Http\Controllers;

use App\User;
use App\Conversation;
use App\PrivateMessage;
use Illuminate\Http\Request;


class UsersController extends Controller
{
    public function show($username)
    {
      //busco al usuario y muestro los mensajes en una vista, con first me da el primero
      $user = $this->findByUsername($username);
      return view('users.show', [
        'user' => $user,
      ]);
    }

    public function follow($username, Request $request)
    {
      $user = $this->findByUsername($username);

      //aqui pido el usuario logeado que viene en el post
      $me = $request->user();

      //al usuario logeado de sus follows agregue el usuario en cuestion
      $me->follows()->attach($user);

      //aqui se redirige al usuario que esta siguiendo
      return redirect("/$username")->withSuccess('Usuario seguido');
    }

    public function unfollow($username, Request $request)
    {
      $user = $this->findByUsername($username);

      //aqui pido el usuario logeado que viene en el post
      $me = $request->user();

      //al usuario logeado de sus follows agregue el usuario en cuestion
      $me->follows()->detach($user);

      //aqui se redirige al usuario que esta siguiendo
      return redirect("/$username")->withSuccess('Usuario no seguido');
    }

    public function follows($username)
    {
      $user = $this->findByUsername($username);
      return view('users.follows', [
        'user' => $user,
        'follows' => $user->follows,
      ]);
    }

    public function followers($username)
    {
      $user = $this->findByUsername($username);
      return view('users.follows', [
        'user' => $user,
        'follows' => $user->followers,
      ]);
    }

    public function sendPrivateMessage($username, Request $request)
    {
      $user = $this->findByUsername($username);

      $me = $request->user();
      $message = $request->input('message');

      //voy a tener que crear una conversion entre estos dos usuarios
      $conversation = Conversation::create();
      //para agregar usuarios a la conversacion
      $conversation->users()->attach($me);
      $conversation->users()->attach($user);
      //voy a crear un mensaje privado mio hacia el usuario (hacia la conversacion)
      $privateMessage = PrivateMessage::create([
        'conversation_id' => $conversation->id,
        'user_id' => $me->id,
        'message' => $message,
      ]);
      //redirigir a la vista de la conversacion
      return redirect('/conversations/'.$conversation->id);

    }

    public function showConversation(Conversation $conversation)
    {
      //le digo que cargue usuarios y mensajes
      $conversation->load('users', 'privateMessages');
      return view('users.conversation', [
        'conversation' => $conversation,
        'user' => auth()->user(),
      ]);
    }

    private function findByUsername($username)
    {
      return User::where('username',$username)->first();
    }
}
