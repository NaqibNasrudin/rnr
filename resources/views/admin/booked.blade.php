@extends('navbar_admin')

@section('content')
@foreach ($data as $data)
    {{$data->vehicle_id}} <br>
    {{$data->pickup_date}} <br>
    {{$data->return_date}} <br>
@endforeach
@endsection
