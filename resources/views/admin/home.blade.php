@extends('layouts.dashboard')

@section('content')
    <h1>Dashboard privata</h1>
    <div>Benvenuto {{ $user->name }}</div>

    <div>La tua email è {{ $user->email }}</div>
@endsection