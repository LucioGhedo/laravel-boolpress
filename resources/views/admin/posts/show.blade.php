@extends('layouts.dashboard')

@section('content')
    <h1>{{$post['title']}}</h1>

    <p>{{$post['content']}}</p>

    <p>Slug: {{ $post->slug }}</p>

    <p>Creato il: {{ $post->created_at->format('j/m/Y') }} alle {{ $post->created_at->format('G:i:s') }}</p>

    <p>Created {{ $diff }} {{ $diff < 24 ? '' : $diff_hours}}</p>

    <p>Categoria: {{ $post->category ? $post->category->name : 'nessuna' }}</p>

    <p>
        @if (count($post->tags->toArray()))
            <strong>Tags:</strong>
            @foreach ($post->tags as $tag)
                {{ $tag->name }}{{ !$loop->last ? ',' : '' }}
            @endforeach
        @else
        Nessun tag
        @endif
    </p>

    <a href="{{ route('admin.posts.edit', ['post' => $post['id']]) }}" class="btn btn-primary">Edit Post</a>

    <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')

        <input type="submit" value="Cancella Post" class="btn btn-danger mt-2">
    </form>
@endsection