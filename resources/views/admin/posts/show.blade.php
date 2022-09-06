@extends('layouts.dashboard')

@section('content')
    <h1>{{$post['title']}}</h1>
    <p>{{$post['content']}}</p>
    <p>Creato il: {{ $post->created_at->format('j/m/Y') }} alle {{ $post->created_at->format('G:i:s') }}</p>
    <p>Created {{ $diff }} {{ $diff < 24 ? '' : $diff_hours}}</p>
    <a href="{{ route('admin.posts.edit', ['post' => $post['id']]) }}" class="btn btn-primary">Edit Post</a>
    <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Cancella Post" class="btn btn-danger mt-2">
    </form>
@endsection