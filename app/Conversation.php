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
      return $this->hasMany(PrivateMessage::class);

    }
}
