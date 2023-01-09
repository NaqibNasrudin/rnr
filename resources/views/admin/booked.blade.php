@extends('navbar_admin')
<link rel="stylesheet" href="{{asset('css/booked.css')}}">
@section('content')
<h2>Booked Vehicle</h2>
<div class="card">
    @foreach ($data as $data)
        <div class="card_content">
            <div class="image">
                <img src="{{asset("img/{$data->img_name}")}}" alt="">
            </div>
            <div class="detail">
                <p>Plate Number   : {{$data->plate_number}}</p>
                <p>Motorcycle     : {{$data->brand}} {{$data->model}}</p>
                <p>Qubic Capacity : {{$data->cc}} CC</p>
                <p>Pickup : {{$data->pickup_date}}</p>
                <p>Return : {{$data->return_date}}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
