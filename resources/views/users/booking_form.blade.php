@extends('navbar')
<link rel="stylesheet" href="{{asset('css/booking_form.css')}}">
@section('content')
<div class="content_parent">
    <div class="content">
        <div class="info">
            <div class="img">
                <img src="{{asset("img/{$vehicle->img_name}")}}" alt="">
            </div>
            <div class="details">
                <p>{{$vehicle->brand}} {{$vehicle->model}}</p>
                <p>{{$vehicle->cc}} cc</p>
            </div>
        </div>
        <div class="booking_form">
            <form action="/Store_booking/{{$vehicle->vehicle_id}}" method="POST">
                @csrf
                @php
                    $newpickupdate = date("F d, Y", strtotime($pickup));
                    $newreturndate = date("F d, Y", strtotime($return));
                @endphp
                <div class="user_info">
                    <div class="dates">
                        <div class="pickup">
                            <p>Pickup</p>
                            <p>{{$newpickupdate}}</p>
                        </div>
                        <div class="return">
                            <p>Return</p>
                            <p>{{$newreturndate}}</p>
                        </div>

                    </div>
                    <div class="price">
                        <p>RM {{$total}}</p>
                    </div>
                    <br>
                </div>
                <hr>
                <br>
                <h2>Enter Your Details :</h2>
                <input type="text" value="{{$user->name}}" name="name" >
                <br>
                <input type="text" value="{{$user->email}}" name="email" >
                <br>
                {{-- <label for="">Pickup Date : </label> --}}
                <input type="date" name="pickup" name="pickup" value="{{$pickup}}" hidden>
                {{-- <label for="">Return Date : </label> --}}
                <input type="date" name="return" name="return" value="{{$return}}" hidden>
                <input type="text" placeholder="Phone Number" name="phoneno">
                <input type="text" name="price" value="{{$total}}" hidden>
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <br>
                <input type="submit" value="Book Now">
            </form>
        </div>
    </div>
</div>
@endsection
