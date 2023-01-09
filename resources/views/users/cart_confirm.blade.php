@extends('navbar')
<link rel="stylesheet" href="{{asset('css/cart_confirm.css')}}">
@section('content')
<div class="container">
    <div class="card">

            @foreach ($data as $d)
            <div class="card_content">
                <div class="image">
                    <img src="{{asset("img/{$d->img_name}")}}" alt="">
                </div>
                <div class="card_detail">
                    <p>{{$d->plate_number}}</p>
                    <p>{{$d->brand}} {{$d->model}}</p>
                </div>
            </div>
            @endforeach
    </div>
    <div class="form">
        <form action="/CheckoutStore" method="POST">
            @csrf
            <h2>Checkout Details</h2><br>
            <h4>Username : {{$user->name}} <br><br> Email : {{$user->email}}</h4>
            <br>
            <div class="user_info">
                <div class="price">
                    <p>Total Price : RM {{$total}}</p>
                </div>
            </div>
            <input type="text" name="name" value="{{$user->name}}" hidden>
            <br>
            <input type="text" name="email" value="{{$user->email}}" hidden>
            <br>
            @foreach ($data as $data)
                <input type="text" name="vehicleid[]" value="{{$data->vehicle_id}}" hidden>
                <input type="text" name="pickup[]" value="{{$data->pickup_date}}" hidden>
                <input type="text" name="return[]" value="{{$data->return_date}}" hidden>
            @endforeach
            <br>
            <input type="text" name="total" value="{{$total}}" hidden>
            <input type="text" placeholder="Phone Number" name="phoneno">
            <br>
            <input type="submit">
        </form>
    </div>
</div>
@endsection
