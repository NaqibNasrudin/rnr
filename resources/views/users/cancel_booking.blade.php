@extends('navbar')
<link rel="stylesheet" href="{{asset('css/cancel_booking.css')}}">
@section('content')
<div class="confirm">
    <div class="content">
        <h2>Are you sure you want to cancel this booking?</h2>
        <div class="card">
            <div class="detail">
                <div class="card_content">
                    <p>{{$vehidata->brand}} {{$vehidata->model}}</p>
                    <p>{{$vehidata->plate_number}}</p>
                    <p>{{$vehidata->pickup_date}} until {{$vehidata->return_date}}</p>
                    <br>
                </div>
                <div class="image">
                    <img src="{{asset("img/{$vehidata->img_name}")}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <p>*Any refund shall be made within 2-3 working days. Please reach us for any inquiries.</p>
    <div class="yesno">
        <a href="/Profile"><button class="no">No</button></a>
        <a href="/Confirm/{{$vehidata->book_id}}"><button class="yes">Confirm</button></a>
    </div>
</div>
@endsection
