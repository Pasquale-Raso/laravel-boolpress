@extends('layouts/app')

@section('content')
<div class="container">
        

{{-- VALIDAZIONE fatta su store nel controller --}}
  @if ($errors->any())
    <div class="mt-3 p-0 pt-2 alert alert-danger container-form">
      <ul>
        @foreach ($errors->all() as $error) 
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div> 
  @endif
{{-----------------}}
  <form class="container mt-2 " action="{{route('admin.posts.update', $post->id)}}" method="POST">
    @csrf
    @method('PATCH')
    <h3 class="text-center mb-5">Crea un nuovo post</h3>
    <div class=" mb-4 d-flex align-items-center justify-content-center justify-content-between">
      <label class="mr-5" for="title">Titolo</label>
      <input class="form-control @error("title") is-invalid @enderror" type="text" name="title" id="title" value="{{old('title',$post->title)}}">

      {{-- per far uscire sotto il box la scritta di errore {{$message}} lo da in automatico laravel --}}
      @error('title')
         <div class="invalid-feedback">
          <h6 class="text-end ml-5">{{ $message }}</h6>
        </div> 
      @enderror
    </div>

      <div class="mb-4 d-flex align-items-center justify-content-center justify-content-between">
        <label class="mr-4" for="content">Descrizione</label>
        <textarea class="form-control @error("content") is-invalid @enderror" name="content" id="content">{{ old('content',$post->content)}}</textarea>

        {{-- per far uscire sotto il box la scritta di errore {{$message}} lo da in automatico laravel --}}
      @error('content')
         <div class="invalid-feedback">
          <h6 class="text-end ml-5">{{ $message }}</h6>
        </div> 
      @enderror
        </div>
      
      <div class=" mb-4 d-flex align-items-center justify-content-center justify-content-between">
        <label class="mr-4" for="image">Immagine</label>
        <input  class="form-control @error("image") is-invalid @enderror" type="text" name="image" id="image" value="{{old('image',$post->image)}}">
         {{-- per far uscire sotto il box la scritta di errore {{$message}} lo da in automatico laravel --}}
      @error('image')
         <div class="invalid-feedback">
          <h6 class="text-end ml-5">{{ $message }}</h6>
        </div> 
      @enderror
      </div>

      <div class="form-group mb-4 d-flex align-items-center justify-content-center justify-content-between">
        <label class="mr-4" for="category_id">Categoria</label>
        <select class="form-control" id="category_id" name="category_id">
          <option>Nessuna categoria</option>
          @foreach ($categories as $category)
            <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>  
          @endforeach
        </select>
      </div>
      
      <div class="d-flex align-items-center">
        <h6 class="mr-5">Tags</h6>
        @foreach ($tags as $tag)
          <div class="form-check form-check-inline ">
          <input class="form-check-input" type="checkbox" id="tags-{{$tag->id}}" value="{{$tag->id}}"
              name="tags[]" @if (in_array($tag->id, old('tags', $tagIds ?? []))) checked @endif>
          <label class="form-check-label" for="tags-{{$tag->id}}">{{$tag->name}}</label>
        </div>
        @endforeach
      </div>

      <hr>
      <div class="d-flex align-items-center justify-content-center mb-5">
        <button class="btn btn-success" type="submit" value="Invia">Invia</button>
      </div>
  </form>
      <hr>
    <div class="container-form d-flex justify-content-center mt-5">
      <a href="{{ route('admin.posts.index')}}"><button class="btn btn-primary" type="submit" value="Torna alla lista">Torna ai tuoi post</button></a>
</body>
</div>   
@endsection