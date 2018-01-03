<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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

    private function findByUsername($username)
    {
      return User::where('username',$username)->first();
    }
}
