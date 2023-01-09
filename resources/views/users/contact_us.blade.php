@extends('navbar')
<link rel="stylesheet" href="{{asset('css/contact_us.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section('content')
<div class="content">
    <h1>Contact Us</h1>
    <div class="contact_detail">
        <div class="contact">
            <div class="phone">
                <a href="#" class="fa fa-phone"></a>
                <p>+60125004023 </p>
            </div>
            <div class="mail">
                <a href="mailto:guhs5585@gmail.com" class="fa fa-envelope"></a>
                <p>guhs5585@gmail.com</p>
            </div>
            <div class="address">
                <a href="#" class="fa fa-map-marker"></a>
                <p>Pangkor Ferry Jetty, Pangkor, 32300 Pulau Pangkor, Perak</p>
            </div>

        </div>
        <div class="social_media">
            <a href="https://www.facebook.com/Pangkorpbc" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="https://api.whatsapp.com/send?phone=%2B60125004023&fbclid=IwAR2q6ejaltzhrZnJb4YlNIqevqvUc2tAGi4TS5PuT9GWlGy-mxclqnq6xao" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>

        </div>
    </div>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d994.7582002060291!2d100.57566422192203!3d4.213854031467304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3034d3a5b90cd219%3A0x5641ce2a281c277f!2sPangkor%20Ferry%20Jetty!5e0!3m2!1sen!2smy!4v1673146611932!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
@endsection
