@extends('layouts.dashboard')

@section('content')
    <h1>Crea post</h1>
    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf
        @method('POST')

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
          <input type="text" class="form-control" id="title" placeholder="Titolo" name="title" value="{{ old('title') }}">
        </div>

        <div class="form-group">
          <label for="content">Content</label>
          <textarea class="form-control" id="content" placeholder="Content" name="content">{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
@endsection