@extends('navbar')

@section('content')
<div class="card">
    <div class="card_left">
        <h3>{{ $vehicle->plate_number }}</h3>
        <img src="{{asset("img/{$vehicle->img_name}")}}" alt="">
    </div>
    <div class="card_right">
        <p>{{$vehicle->brand}} </p>
        <p>{{$vehicle->model}}</p>
        <p>{{$vehicle->cc}}</p>
        <p>{{$vehicle->price}}</p>
        <a href="/Book/{{$vehicle->vehicle_id}}/from{{$pickup}}to{{$return}}/Booking_form"><button>Book Now</button></a>
        <a href="/Cart/{{$vehicle->vehicle_id}}/from{{$pickup}}to{{$return}}"><button>Add to Cart</button></a>
    </div>
</div>
@endsection
