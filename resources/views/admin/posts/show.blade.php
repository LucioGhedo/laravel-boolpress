@extends('layouts.dashboard')

@section('content')
    <h1>{{$data['post']['title']}}</h1>
    <p>{{$data['post']['content']}}</p>
@endsection