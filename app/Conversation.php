<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function users()
    {
      return $this->belongsToMany(User::class);
    }

    public function privateMessages()
    {
      //relacion en donde una conversacion tiene muchos mensajes privados
      return $this->hasMany(PrivateMessage::class)->orderBy('created_at', 'desc');

    }

    public static function between(User $user, User $other)
    {
      //tengo que usar una relación entre una conversación y los usuarios
      // si no encuentra conversación debe crearla

      $query =  Conversation::whereHas('users', function ($query) use ($user){
        $query->where('user_id', $user->id);
      })->whereHas('users', function ($query) use ($other) {
        $query->where('user_id', $other->id);
      });
      //recibe un array de atributos, si existe una conversacion con esos atributos, la devuelve
      //si no la crea
      $conversation = $query->firstOrCreate([]);

      //el metodo sync recibe los id de los usuarios, va a garantizar que los usaurios esten
      $conversation->users()->sync([
        $user->id, $other->id
      ]);

      return $conversation;

    }
}
