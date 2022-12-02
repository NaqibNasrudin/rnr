@extends('navbar')
<link rel="stylesheet" href="{{asset('css/catalog.css')}}">
@section('content')
<div class="content">
    <div class="filter">
        <div class="search">
            <form action="/Book" method="POST">
                @csrf
                <label for="">Pickup Date : </label>
                <input type="date" name="pickup" value="{{$pickup}}">

                <br>
                <label for="">Return Date : </label>
                <input type="date" name="return" value="{{$return}}">
                <br>
                <input type="submit" class="submit">
            </form>
        </div>
        <div class="filter_field">
            <h2>filter</h2>
            <label for="price">Price: </label>
            <input type="range" min="1" max="50" class="slider">
        </div>
    </div>

    <div class="card">
        @foreach ($data as $data)
        <a href="/Book/{{$data->vehicle_id}}/from{{$pickup}}to{{$return}}/Vehicle_detail">
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
