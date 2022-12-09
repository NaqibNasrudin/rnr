@extends('navbar')

@section('content')
<div class="receipt">
    <p>{{$data->plate_number}}</p>
    <p>{{$data->brand}} {{$data->model}}</p>


    <a href="/Receipt/{{$data->book_id}}"><button>Download Receipt</button></a>
</div>
@endsection
