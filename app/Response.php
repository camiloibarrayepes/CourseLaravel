<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $guarded = [];

    public function user()
    {
      //una respuesta tiene un usuario
      return $this->belongsTo(User::class);
    }

    public function message()
    {
      //una respuesta tiene un mensajes
      $this->belongsTo(Message::class);
    }
}
