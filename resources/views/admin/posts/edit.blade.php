@extends('layouts.dashboard')

@section('content')
    <h1>modifica post</h1>
    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div>
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

        <div class="form-group">
          <label for="content">Content</label>
          <textarea class="form-control" id="content" placeholder="Content" rows="10" name="content">{{ old('content', $post->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Salva modifiche</button>
      </form>
@endsection