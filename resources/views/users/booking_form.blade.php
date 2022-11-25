@extends('navbar')

@section('content')
<div class="booking_form">
    <form action="/Store_booking/{{$vehicle->vehicle_id}}" method="POST">
        @csrf
        <input type="text" value="{{$user->name}}" readonly name="name">
        <br>
        <input type="text" value="{{$user->email}}" readonly name="email">
        <br>
        <input type="text" placeholder="Phone Number" name="phoneno">
        <br>
        <label for="">Pickup Date : </label>
        <input type="date" name="pickup" name="pickup">
        <br>
        <label for="">Return Date : </label>
        <input type="date" name="return" name="return">
        <br>
        <input type="submit">
    </form>
</div>
@endsection
