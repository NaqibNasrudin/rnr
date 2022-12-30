@extends('navbar')
<link rel="stylesheet" href="{{asset('css/vehi_detail.css')}}">
@section('content')
<div class="detail">
    <div class="card">
        <div class="card_left">
            <img src="{{asset("img/{$vehicle->img_name}")}}" alt="">
        </div>

        <div class="card_right">
            <div class="title">
                <h2>{{ $vehicle->plate_number }}</h2>
            </div>
            <div class="content">
                <p>Brand : {{$vehicle->brand}} </p>
                <p>Model : {{$vehicle->model}}</p>
                <p>Cubic Capacity : {{$vehicle->cc}}</p>
                <p>Price : {{$vehicle->price}}</p>
            </div>
            <div class="btn">
                <a href="/Book/{{$vehicle->vehicle_id}}/from{{$pickup}}to{{$return}}/Booking_form"><button>Book Now</button></a>
                <a href="/Cart/{{$vehicle->vehicle_id}}/from{{$pickup}}to{{$return}}"><button>Add to Cart</button></a>
            </div>
        </div>
    </div>
</div>
@endsection
