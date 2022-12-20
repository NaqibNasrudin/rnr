@extends('navbar')

@section('content')
<div class="receipt">
    @foreach ($data as $d)
        <p>{{$d->plate_number}}</p>
        <p>{{$d->brand}} {{$d->model}}</p>
    @endforeach



        <form action="/Receipt">
            @csrf
            @foreach ($data as $data)
            <input type="text" value="{{$data->plate_number}}" name="plate[]" hidden>
            <input type="text" value="{{$data->img_name}}" name="img[]" hidden>
            <input type="text" value="{{$data->brand}}" name="brand[]" hidden>
            <input type="text" value="{{$data->model}}" name="model[]" hidden>

            <input type="text" value="{{$data->pickup_date}}" name="pickup[]" hidden>
            <input type="text" value="{{$data->return_date}}" name="return[]" hidden>
            @endforeach
            <input type="submit" value="Download Receipt">
        </form>


</div>
@endsection
