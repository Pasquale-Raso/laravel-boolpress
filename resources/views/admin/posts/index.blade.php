@extends('layouts.app')
@section('content')
    <div class="container">
        @if ( session('alert-message' ))
            <div class="alert alert-{{ session('alert-type') }}">
            {{ session('alert-message' )}}
            </div>   
        @endif
        <div class="my-2 d-flex justify-content-between align-items-center">
            <h3>I tuoi post</h3>
            <a href="{{route('admin.posts.create')}}" class="btn btn-success p-1" >Nuovo post</a>
        </div>
        <table class="table table-primary">
        <thead>
            <tr>
            <th class="bg-secondary text-white" scope="col">Id</th>
            <th class="bg-secondary text-white" scope="col">Title</th>
            <th class="bg-secondary text-white" scope="col">Scitto il</th>
            <th class="bg-secondary text-white" scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->getFormattedDate('created_at')}}</td>
                <td class="d-flex justify-content-end">
                    <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary ml-2">Vai</a>
                    <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning ml-2">Modifica</a>
                    <form action="{{route('admin.posts.destroy', $post->id)}}" method="post" class="delete-button">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ml-2">Elimina</button>
                    </form>
                </td>
            </tr>
                
            @empty
                <tr>
                    <td colspan="3" class="text-center">
                        Non ci sono post da visualizzare
                    </td>
                </tr>
                
            @endforelse
        </tbody>
        </table>

        {{-- creo pulsanti di navigazione da paginate su PostController --}}
        <footer class="d-flex justify-content-center">
            {{$posts->links()}}
        </footer>
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