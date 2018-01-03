<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*Explicacion:
        el gate es autorizacion
        con la funcion define defino una clave y luego una funcion que dice si el usuario puede o
        no hacer esto, nuestra clave va a ser dms, luego una funcion anonima que recibira como parametros
        el usuario logeado y $other el usuario al que queremos enviar el mensaje,
        nuestra regla debe ser que yo sigo al otro y el otro me sigue a mi
        return $user->isFollowing($other) usuario logeado esta siguiendo al usuario actual
        $other->isFollowing($user); y el otro usuario me sigue, la funcion isFollowing esta implementada
        en el modelo User, donde comprueba  que contenga al usuario en cuestion
        */
        Gate::define('dms', function(User $user, User $other){
          return $user->isFollowing($other) &&
          $other->isFollowing($user);
        });
    }
}
