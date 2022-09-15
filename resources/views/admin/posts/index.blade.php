@extends('layouts.dashboard')

@section('content')
    <h1>Lista Post</h1>
    <div class="row g-5">
        @foreach ($posts as $post)
            <div class="card-deck col-4 mt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        @if ($post->cover)
                            <img src="{{ asset('storage/' . $post->cover) }}" :alt="{{$post->title}}" style="width: 390px; margin-bottom: 10px">
                        @endif
                        <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Dettagli</a>
                        <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Cancella Post" class=" btn btn-danger mt-2">
                        </form>
                    </div>
                    <div class="card-footer">
                      <small class="text-muted">{{ $post->created_at->diffForHumans($now) }}</small>
                    </div>
                  </div>
              </div>
        @endforeach
        <div class="mt-2">
            {{ $posts->links() }}
        </div>
    </div>
@endsection