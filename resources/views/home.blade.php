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
            <div class="history_card">
                @foreach ($history as $history)
                    <div class="card_content">
                        <p>{{$history->brand}} {{$history->model}}</p>
                        <p>{{$history->plate_number}}</p>
                        <p>{{$history->pickup_date}}</p>
                        <p>{{$history->return_date}}</p>
                    </div>
                @endforeach
            </div>
    @endif
</div>

@endsection
