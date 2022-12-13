@extends('navbar')

@section('content')
@foreach ($data as $data)
    <p>{{$data->vehicle_id}}</p>
    <p>{{$data->brand}} {{$data->model}}</p>
@endforeach
<button onclick="history.go(-2)">Continue Booking</button>
<a href="/Checkout"><button>Checkout</button></a>
@endsection
