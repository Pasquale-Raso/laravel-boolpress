@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>{{$post->title}}</h3>
        <p>{{$post->content}}</p>
        <address>{{$post->getFormattedDate('created_at')}}</address>
    </div>
@endsection