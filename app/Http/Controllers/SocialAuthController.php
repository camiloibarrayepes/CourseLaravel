<?php

namespace App\Http\Controllers;

use App\User;
use App\SocialProfile;
use Illuminate\Http\Request;
use Socialite;


class SocialAuthController extends Controller
{
    public function facebook()
    {
      return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
      //esta es la ruta donde volviste y dame los dats que traes de facebook
      $user = Socialite::driver('facebook')->user();
      //aqui debo crear un form para guardar los datos de facebook
      //ya tenemos le modelo SocialProfile

      //antes de mostrar el form, hago una query para ver si ya existe
      $existing = User::whereHas('socialProfiles', function ($query) use ($user) {
        $query->where('social_id', $user->id);
      })->first();

      if($existing !== null){
        auth()->login($existing);
        return redirect('/');
      }

      session()->flash('facebookUser', $user);

      return view('users.facebook', [
        'user' => $user,
      ]);
    }

    public function register(Request $request)
    {
      $data = session('facebookUser');
      $username = $request->input('username');

      //aqui voy a crear un usuario y un perfil relacionado al usuario
      $user = User::create([
        'name' => $data->name,
        'email' => $data->email,
        'avatar' => $data->avatar,
        'username' => $username,
        'password' => str_random(16),
      ]);

      $profile = SocialProfile::create([
        'social_id' => $data->id,
        'user_id' => $user->id,
      ]);

      //por ultimo lo logueamos

      auth()->login($user);

      return redirect('/');
    }
}
