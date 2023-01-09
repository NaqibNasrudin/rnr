@extends('navbar_admin')
<link rel="stylesheet" href="{{asset('css/upload.css')}}">
@section('content')
<div class="upload">
    <h1>Upload New Vehicle</h1>
    <div class="upload_form">
        <form action="/Store_info" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="Plate Number" name="plate">
            <br>
            <input type="text" placeholder="Brand" name="brand">
            <br>
            <input type="text" placeholder="Model" name="model">
            <br>
            <input type="text" placeholder="Cubic Capacity" name="cc">
            <br>
            <input type="text" value="RM " name="price">
            <br>
            <label for="">Select Image : </label>
            <input type="file" name="img">
            <br>
            <input type="submit">
        </form>
    </div>
</div>
@endsection
