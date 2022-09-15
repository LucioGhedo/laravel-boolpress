@extends('layouts.dashboard')

@section('content')
    <h1>Crea post</h1>
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

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
          <input type="text" class="form-control" id="title" placeholder="Titolo" name="title" value="{{ old('title') }}">
        </div>

        <div class="mt-5 mb-5">
          <h3>Tags</h3>
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
        </div>
        
        <div class="form-group mt-5">
          <label for="content">Content</label>
          <textarea class="form-control" id="content" placeholder="Content" rows="10" name="content">{{ old('content') }}</textarea>
        </div>

        <label for="category_id">Categoria</label>
        <select class="form-select" aria-label="Default select example" name="category_id" id="category_id">
          <option value="">Nessuna categoria</option>
          @foreach ($categories as $category)
            <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
          @endforeach
        </select>

        <div class="mb-3">
          <label for="image" class="form-label">Default file input example</label>
          <input class="form-control" type="file" id="image" name="image">
        </div>

        <button type="submit" class="btn d-block mt-5 btn-primary">Submit</button>
      </form>
@endsection