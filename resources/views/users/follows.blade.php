@extends('layouts.app')

@section('content')

<h1>{{ $user->name }}</h1>
<ul class="list-unstyled">
@foreach($follows as $f)
  <li>{{ $f->username }}</li>
@endforeach
</ul>
@endsection
