@extends('layouts.dashboard')

@section('content')
    <h1>Lista Post</h1>
    <div class="row g-5">
        @foreach ($posts as $post)
            <div>
                <div class="card mt-4" style="width: 18rem;">
                    <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Dettagli</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection