<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messages()
    {
      //un usuario tiene muchos mensajes
      //le decimos al modelo de usuarios que el modelos Messages tiene su id
      //en vez de el tener un id local de messages id alguien tiene su user_id y tiene muchos
      return $this->hasMany(Message::class)->orderBy('created_at', 'desc');
    }

    public function follows()
    {
      return $this->belongsToMany(User::class, 'followers', 'user_id', 'followed_id');
      //tabla followers, llave foranea, related (los que siguen, el usuario al que siguen)
    }

    public function followers()
    {
      return $this->belongsToMany(User::class, 'followers', 'followed_id', 'user_id');
      //tabla followers, pero leida al reves, yo soy el que he seguido, dime quienes son los que me siguen
    }

    public function isFollowing(User $user)
    {
      return $this->follows->contains($user);
    }

    public function socialProfiles()
    {
      //un usuario tiene muchos perfiles, pero el perfil pertenece solo a un usuario
      return $this->hasMany(SocialProfile::class);
    }
}
