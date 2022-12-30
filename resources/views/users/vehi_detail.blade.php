@extends('navbar')
<link rel="stylesheet" href="{{asset('css/vehi_detail.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <p><b>Vehicle Detail :</b></p>
                <p>Brand : {{$vehicle->brand}} </p>
                <p>Model : {{$vehicle->model}}</p>
                <p>Cubic Capacity : {{$vehicle->cc}}</p>
                <p class="price"><b>{{$vehicle->price}}</b></p>
            </div>
            <div class="btn">
                <a href="/Cart/{{$vehicle->vehicle_id}}/from{{$pickup}}to{{$return}}"><button>Add to Cart <i class="fa fa-shopping-cart"></i></button></a>
                <a href="/Book/{{$vehicle->vehicle_id}}/from{{$pickup}}to{{$return}}/Booking_form"><button>Book Now</button></a>
            </div>
        </div>
    </div>
</div>
@endsection
