@extends('navbar')

@section('content')
<div class="card">
    <h3>{{ $vehicle->plate_number }}</h3>
    <img src="{{asset("img/{$vehicle->img_name}")}}" alt="">
    <p>{{$vehicle->brand}} </p>
    <p>{{$vehicle->model}}</p>
    <p>{{$vehicle->cc}}</p>
    <p>{{$vehicle->price}}</p>
    <a href="/Book/{{$vehicle->vehicle_id}}/from{{$pickup}}to{{$return}}/Booking_form"><button>Book Now</button></a>
</div>
@endsection
