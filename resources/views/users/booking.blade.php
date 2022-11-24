@extends('navbar')
<link rel="stylesheet" href="{{asset('css/booking.css')}}">
@section('content')
<div class="content">
    <div class="filter">
        <h2>filter</h2>
        <label for="price">Price: </label>
        <input type="range" min="1" max="50" class="slider">
    </div>
    <div class="card">
        @foreach ($data as $data)
        <a href="/Book/{{$data->vehicle_id}}/Booking_form">
            <div class="card_content">
                <h3>{{ $data->plate_number }}</h3>
                <img src="{{asset("img/{$data->img_name}")}}" alt="">
                <hr>
                <p>{{$data->brand}} {{$data->model}}</p>
                <h4>{{$data->price}}</h4>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
