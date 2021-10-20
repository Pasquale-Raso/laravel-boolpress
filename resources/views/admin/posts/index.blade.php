@extends('layouts.app')
@section('content')
<div class="container">
    <h3>I miei post</h3>
    <table class="table table-primary">
    <thead>
        <tr>
        <th class="bg-secondary text-white" scope="col">Title</th>
        <th class="bg-secondary text-white" scope="col">Scitto il</th>
        <th class="bg-secondary text-white" scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($posts as $post)
        <tr>
            <td>{{$post->title}}</td>
            <td>{{$post->getFormattedDate('created_at')}}</td>
            <td><a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary">Vai</a></td>
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
    
@endsection