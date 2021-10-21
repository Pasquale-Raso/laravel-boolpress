@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>{{$post->title}}</h3>
        <h5> Categoria: @if ($post->category) {{ $post->category->name }} @else nessuna categoria @endif</h5>
        <p>{{$post->content}}</p>
        <address>{{$post->getFormattedDate('created_at')}}</address>
    </div>
     <hr>
    <div class="container d-flex justify-content-center mt-5">
      <a href="{{ route('admin.posts.index')}}"><button class="btn btn-primary" type="submit" value="Torna alla lista">Torna ai tuoi post</button></a>
      <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning ml-2">Modifica</a>
        <form action="{{route('admin.posts.destroy', $post->id)}}" method="post" class="delete-button">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger ml-2">Elimina</button>
        </form>
    </div>
    <script>
            const deleteButtons = document.querySelectorAll('.delete-button');
                deleteButtons.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const conf = confirm('Sei sicuro di voler cancellare questo post?');
                        if (conf) this.submit();
                    });
                });
        </script>
@endsection