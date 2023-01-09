@extends('navbar_admin')
<link rel="stylesheet" href="{{asset('css/edit.css')}}">
@section('content')
<h2>Edit Vehicle</h2>
<div class="card">
    <img src="{{asset("img/{$data->img_name}")}}" alt="">
    <div class="form">
        <form action="/Edit_confirm/{{$data->vehicle_id}}" method="POST">
            @csrf
            <input type="text" value="{{$data->plate_number}}" name="plate">
            <br>
            <input type="text" value="{{$data->model}}" name="model">
            <br>
            <input type="text" value="{{$data->brand}}" name="brand">
            <br>
            <input type="text" value="{{$data->cc}}" name="cc">
            <br>
            <input type="text" value="{{$data->price}}" name="price">
            <br>
            <input type="submit">
        </form>
    </div>
</div>
@endsection
