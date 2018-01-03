<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //propiedad protegida
    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
