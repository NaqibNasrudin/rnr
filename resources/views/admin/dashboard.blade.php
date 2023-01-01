@extends('navbar_admin')
<link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
@section('content')
<div class="content">
    <div class="card">
        @foreach ($data as $data)
            <div class="card_content">
                <h2>{{ $data->plate_number }}</h2>
                <img src="{{asset("img/{$data->img_name}")}}" alt="">
                <p>Brand : {{$data->brand}}</p>
                <p>Model : {{$data->model}}</p>
                <p>Cubic Capacity (cc) : {{$data->cc}}</p>
                <h4>{{$data->price}}</h4>
                <a href="/Delete/{{ $data->vehicle_id }}">Delete</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
