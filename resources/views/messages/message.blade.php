<!-- Si solo usamos imagenes del Storage
<img class="img-thumbnail" src="{{ Storage::disk('public')->url($message->image) }}">
-->
<!-- Como ya hicimos un condicional para ver si la imagen es de URL o de STORAGE,
se deja el src {{ $message->image }}-->
<img class="img-thumbnail" src="{{ $message->image }}">

<p class="card-text">
  <div class="text-muted">Escrito por: <a href="{{ $message->user->username }}">{{ $message->user->name }}</a></div>
  {{ $message->content }}
  <a href="/messages/{{ $message->id }}">Leer mas</a>

</p>
<div class="card-text text-muted float-right">
  {{ $message->created_at }}
</div>
