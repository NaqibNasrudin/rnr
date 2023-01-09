@extends('navbar')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@section('content')

<h2>Your Cart</h2>
@if ( count($data) == 0 )
    <div class="no_item">
        <p>No Items</p>
    </div>
@else
    <div class="card">
        @foreach ($data as $data)
            <div class="card_content">
                <div class="image">
                    <img src="{{asset("img/{$data->img_name}")}}" alt="">
                </div>
                <div class="detail">
                    <p>{{$data->plate_number}}</p>
                    <p>{{$data->brand}} {{$data->model}}</p>
                    <p>{{$data->cc}} CC</p>
                    <p>{{$data->price}} / night</p>
                </div>
                <div class="delete">
                    <a href="/Delete_Item/{{$data->cart_id}}"><button>Delete</button></a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="btn_action">
        <form action="/Book" method="POST" class="continue_book">
            @csrf
            <input type="text" value="{{$data->pickup_date}}" hidden name="pickup">
            <input type="text" value="{{$data->return_date}}" hidden name="return">
            <input type="submit" value="Continue Booking">
        </form>
        <h3>Total : RM {{$total}}</h3>
        <a href="/Checkout/{{$total}}" class="checkout"><button>Checkout</button></a>
    </div>
@endif

@endsection
