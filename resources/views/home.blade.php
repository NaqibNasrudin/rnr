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
        <p><h2>My Bookings : </h2></p>
        @foreach ($ongoing as $ongoing)
        <div class="history_card">
                    <div class="card_content">
                        <p><h5>{{$ongoing->brand}} {{$ongoing->model}}</h5></p>
                        <p><h6>{{$ongoing->plate_number}}</h6></p>
                        <p><h6>{{$ongoing->pickup_date}} until {{$ongoing->return_date}}</h6></p>
                        <br>
                        <a href="/Cancel_booking/{{$ongoing->book_id}}"><button class="cancel">Cancel This Booking</button></a>
                    </div>
                    <div class="image">
                        <img src="{{asset("img/{$ongoing->img_name}")}}" alt="">
                    </div>
        </div>
        @endforeach
        {{-- <p><h2>Booking History : </h2></p>
            <div class="history_card">
                @foreach ($history as $history)
                    <div class="card_content">
                        <p><h5>{{$history->brand}} {{$history->model}}</h5></p>
                        <p><h6>{{$history->plate_number}}</h6></p>
                        <p><h6>{{$history->pickup_date}} until {{$history->return_date}}</h6></p>
                        <p></p>
                    </div>
                @endforeach
            </div> --}}
    @endif
</div>

@endsection
