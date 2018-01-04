@extends('layouts.app')

@section('content')

<!-- con except podemos armar una colección con todos los datos (usuario y yo) menos uno en especifico
con esto le pido que me de todos los usuarios, menos el logeado except($user->id), es decir muestra solo
al otro usuario y exceptua mi nombre

convertir una coleción de objetos en un string con Implode
implode recibe 2 parametros, el 1 es la propiedad del objeto que tenemos internamente en esta coleccion
si queremos unir los usarios por nombre, como primer parametro ponemos name y el segundo es el
separador entre nombre y nombre ', '
-->
<h3>Conversación con {{ $conversation->users->except($user->id)->implode('name',', ') }}</h3>


  @foreach($conversation->privateMessages as $message)
  <div class="card">
    <div class="card-header">
      <i>{{ $message->user->name }}</i> dijo...
    </div>
    <div class="card-block">
      {{ $message->message }}
    </div>
    <div class="card-footer">
      {{ $message->created_at }}
    </div>
  </div>
  @endforeach
</div>

@endsection
