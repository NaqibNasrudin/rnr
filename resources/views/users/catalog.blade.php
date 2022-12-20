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
        {{-- <div class="filter_field">
            <h2>filter</h2>
            <label for="price">Price: </label>
            <br>
            <input type="radio" name="price" value="below10" id="price" onchange="filter()">
            <label for="">RM0 - RM10</label>
            <br>
            <input type="radio" name="price" value="11to20" id="price">
            <label for="">RM11 - RM20</label>
            <br>
            <input type="radio" name="price" value="above21" id="price">
            <label for="">Above RM21</label>
        </div> --}}
    </div>

    <div class="card">
        @foreach ($data as $data)
        <a href="/Book/{{$data->vehicle_id}}/from{{$pickup}}to{{$return}}/Vehicle_detail">
            <div class="card_content" id="{{$data->price}}" class="items">
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
<script src="{{asset('js/catalog.js')}}"></script>
@endsection
