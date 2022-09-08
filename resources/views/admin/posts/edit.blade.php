@extends('layouts.dashboard')

@section('content')
    <h1>modifica post</h1>
    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
          <label for="title">Titolo</label>
          <input type="text" class="form-control" id="title" placeholder="Titolo" name="title" value="{{ old('title', $post->title) }}">
        </div>

        <div class="mt-5 mb-5">
          <h3>Tags</h3>
            @if ($errors->any())
              @foreach ($tags as $tag)
                <div class="form-check">
                  <input class="form-check-input" 
                  type="checkbox" 
                  value="{{ $tag->id }}" 
                  id="tag-{{ $tag->id }}" 
                  name="tags[]"
                  {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                  >
                  <label class="form-check-label" for="tag-{{ $tag->id }}">
                    {{$tag->name}}
                  </label>
                </div>
              @endforeach
            @else
              @foreach ($tags as $tag)
                <div class="form-check">
                  <input class="form-check-input" 
                  type="checkbox" 
                  value="{{ $tag->id }}" 
                  id="tag-{{ $tag->id }}" 
                  name="tags[]"
                  {{ $post->tags->contains($tag) ? 'checked' : '' }}
                  >
                  <label class="form-check-label" for="tag-{{ $tag->id }}">
                    {{$tag->name}}
                  </label>
                </div>
              @endforeach
            @endif
            
        </div>

        <label for="category_id">Categoria</label>
        <select class="form-select" aria-label="Default select example" name="category_id" id="category_id">
          <option value="">Nessuna categoria</option>
          @foreach ($categories as $category)
            <option value="{{$category->id}}" {{ old('category_id', $post->category ? $post->category->id : '') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
          @endforeach
        </select>

        <div class="form-group">
          <label for="content">Content</label>
          <textarea class="form-control" id="content" placeholder="Content" rows="10" name="content">{{ old('content', $post->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Salva modifiche</button>
      </form>
@endsection