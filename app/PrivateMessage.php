<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
    //esta propiedad protegida permite que se cree un mensaje con todos los parametros necesarios
    protected $guarded = [];

    //un mensaje privado, tiene un user_id, es decir que pertenece a un usuario
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
