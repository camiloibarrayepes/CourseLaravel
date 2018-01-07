<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class UsersTest extends TestCase
{
  //Se Usa para no guardar registros creados en pruebas
  use DatabaseTransactions;
  use InteractsWithDatabase;

  public function testCanSeeUserPage()
  {
    $user = factory(User::class)->create();
    $response = $this->get($user->username);
    $response->assertSee($user->name);
  }

  public function testCanLogin()
  {
    $user = factory(User::class)->create();
    $response = $this->post('/login', [
      'email' => $user->email,
      'password' => 'secret',
    ]);

    $this->assertAuthenticatedAs($user);
  }


  //Probar si un usuario puede seguir a otro usuario
  public function testCanFollow()
  {
    $user = factory(User::class)->create();
    $other = factory(User::class)->create();

    //actingAs es un metodo que logea el usuario
    $response = $this->actingAs($user)->post($other->username.'/follow');
    //quiero saber si en DB hay relacion entre un usuario y otro, para eso usamos
    //InteractWithDatabase, el cual permite preguntar a la DB si ve algun cambio
    $this->assertDatabaseHas('followers', [
      'user_id' => $user->id,
      'followed_id' => $other->id,
    ]);

  }
}
