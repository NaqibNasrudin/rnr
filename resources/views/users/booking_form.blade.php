@extends('navbar')

@section('content')
<div class="booking_form">
    <form action="" method="POST">
        @csrf
        <input type="text" value="{{$user->name}}" readonly>
        <br>
        <input type="text" value="{{$user->email}}" readonly>
        <br>
        <input type="text" placeholder="Phone Number">
        <br>
        <label for="">Pickup Date : </label>
        <input type="date" name="pickup">
        <br>
        <label for="">Return Date : </label>
        <input type="date" name="return">
    </form>
</div>
@endsection
