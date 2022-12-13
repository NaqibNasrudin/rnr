@extends('navbar')

@section('content')
<div class="card">
    <div class="card_content">
        @foreach ($data as $d)
            <img src="{{asset("img/{$d->img_name}")}}" alt="">
            <div class="card_detail">
                <p>{{$d->plate_number}}</p>
                <p>{{$d->brand}} {{$d->model}}</p>
            </div>
        @endforeach
    </div>
</div>

<form action="/CheckoutStore" method="POST">
    @csrf
    <input type="text" name="name" value="{{$user->name}}" readonly>
    <br>
    <input type="text" name="email" value="{{$user->email}}" readonly>
    <br>
    @foreach ($data as $data)
        <input type="text" name="vehicleid[]" value="{{$data->vehicle_id}}" hidden>
        <input type="text" name="pickup[]" value="{{$data->pickup_date}}" hidden>
        <input type="text" name="return[]" value="{{$data->return_date}}" hidden>
    @endforeach
    <br>
    <input type="text" placeholder="Phone Number" name="phoneno">
    <input type="submit">
</form>
@endsection
