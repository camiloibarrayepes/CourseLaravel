@extends('layouts.app')

@section('content')
<h1>{{ $user->name }} </h1>

<a href="/{{ $user->username }}/follows" class="btn btn-link">
  Sigue a <span class="badge badge-default">{{ $user->follows->count() }}</span>
</a>

<a href="/{{ $user->username }}/followers" class="btn btn-link">
  Seguidores <span class="badge badge-default">{{ $user->followers->count() }}</span>
</a>
<br><br>
<!-- si quiero mostrar todos los mensajes debo hacer foreach -->
@if(Auth::check())

<!-- formulario para envio de DM -->
  @if(Gate::allows('dms', $user))
    <form action="/{{ $user->username }}/dms" method="post">
      <input type="text" name="message" class="form-control">
      <button type="submit" class="btn btn-primary">Enviar DM</button>
    </form>
  @endif
<!-- formulario para envio de DM -->
<br>

  @if(Auth::user()->isFollowing($user))
  <form action="/{{ $user->username }}/unfollow" method="post">
    {{ csrf_field() }}
    @if(session('success'))
    <span class="text-success">{{ session('success') }}</span>
    @endif
    <button class="brn btn-danger">Dejar de seguir</button>
  </form>
  @else
  <form action="/{{ $user->username }}/follow" method="post">
    {{ csrf_field() }}
    @if(session('success'))
    <span class="text-success">{{ session('success') }}</span>
    @endif
    <button class="brn btn-primary">Seguir</button>
  </form>
  @endif
@endif

<br>

<div class="row">
@foreach($user->messages as $message)
  <div class="col-6">
  @include('messages.message')
</div>
@endforeach
</div>

@endsection
