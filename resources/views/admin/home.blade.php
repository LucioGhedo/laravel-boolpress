@extends('layouts.dashboard')

@section('content')
    <h1>Dashboard privata</h1>
    <div>Benvenuto {{ $user->name }}</div>

    <div>La tua email è {{ $user->email }}</div>
    @if ($user->userInfo !== null)
        <div>Numero di telefono {{ $user->userInfo->telephone }}</div>
        <div>Indirizzo: {{ $user->userInfo->address }}</div>
    @endif
@endsection