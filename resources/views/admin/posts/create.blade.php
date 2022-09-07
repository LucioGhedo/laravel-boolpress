@extends('layouts.dashboard')

@section('content')
    <h1>Crea post</h1>
    <form action="{{ route('admin.posts.store') }}" method="POST">
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
        
        <div class="form-group">
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

        <button type="submit" class="btn d-block mt-5 btn-primary">Submit</button>
      </form>
@endsection