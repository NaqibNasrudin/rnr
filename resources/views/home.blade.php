@extends('layouts.app')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@section('content')
<div class="container">
    @if ($idsplit[0] == 'A')
        <h2>{{$name->name}}'s Profile</h2>
        <hr>
        <p>Email Address : {{$name->email}}</p>
        <a href="/Admin"><button>Admin Section</button></a>

    @else
        <h2>{{$name->name}}'s Profile</h2>
        <hr>
        <p>Full Name : {{$name->name}}</p>
        <p>Email Address : {{$name->email}}</p>
        <p>Booking History : </p>

    @endif
</div>

@endsection
