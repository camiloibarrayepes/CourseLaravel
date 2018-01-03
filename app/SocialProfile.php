<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialProfile extends Model
{
    //permitir creacion con guarded

    protected $guarded = [];


    //relacion a la inversa, un perfil pertenece a un solo usuario
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
