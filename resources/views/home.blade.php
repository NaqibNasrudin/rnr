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
        <p><h2>Booking History : </h2></p>
            <div class="history_card">
                @foreach ($history as $history)
                    <div class="card_content">
                        <p><h5>{{$history->brand}} {{$history->model}}</h5></p>
                        <p><h6>{{$history->plate_number}}</h6></p>
                        <p><h6>{{$history->pickup_date}} until {{$history->return_date}}</h6></p>
                        <p></p>
                    </div>
                @endforeach
            </div>
    @endif
</div>

@endsection
