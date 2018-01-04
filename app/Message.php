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

    //getImageAttribute convierte una propiedad en una función
    //getImageAttribute($image) como parametro recibe el valor que tiene la propiedad en BD
    //cuando pida a un message el image, laravel va a llamar a getImageAttribute

    public function getImageAttribute($image)
    {
      if(!$image || starts_with($image, 'http'))
      {
        return $image;
      }

      return \Storage::disk('public')->url($image);

    }
}
