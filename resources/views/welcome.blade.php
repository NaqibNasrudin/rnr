@extends('navbar')

<link rel="stylesheet" href="{{asset('css/welcome.css')}}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://unpkg.com/scrollreveal"></script>

@section('content')
<div class="header" id="header">
    <div class="text" id="text">
        <h1>R&R@Pangkor</h1>
        <p>Rent your best ride to roam around <span>Pangkor</span></p>
    </div>
    <img src="{{asset('img/bg.jpg')}}" alt="" id="bg">
    <img src="{{asset('img/moto.png')}}" alt="" id="moto">
    <a href="#brands"><ion-icon name="arrow-down-outline" id="icon" onclick="showContent()"></ion-icon></a>
</div>


<div class="contents" id="brands">
    <div class="brand" >
        <div class="brandlogo">
            <form action="/Book" method="POST">
                @csrf
                <div class="pickup">
                    <input type="text" name="pickup" id="pickup" onfocus="changepickup()" placeholder="Pickup Date">
                </div>
                <div class="return">
                    <input type="text" name="return" id="return" onfocus="changereturn()" placeholder="Return Date" >
                </div>

                <input type="submit" class="submit" value="Search">
            </form>
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>

    </div>
    <br>
    <div class="info">
    </div>
    <div class="steps">
        <p>HOW IT WORKS?</p>
        <h2>3 Simple Steps to Rent Our Best Bike.</h2>
        <div class="stepsdetail">
            <h2><ion-icon name="search"></ion-icon><br> Search</h2>
            <img src="{{asset('img/rotated-right-arrow.png')}}" alt="">
            <h2><ion-icon name="lock-open"></ion-icon><br> Book</h2>
            <img src="{{asset('img/rotated-right-arrow.png')}}" alt="">
            <h2><ion-icon name="alarm"></ion-icon><br> Pickup</h2>
        </div>
    </div>
    {{-- <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt, consequuntur cum! Quidem culpa corporis, veritatis laborum sed, neque mollitia ipsum numquam molestias ratione et fuga corrupti ipsam dignissimos labore tenetur!</p> --}}
</div>
<div class="content2_container">
    <div class="content2">
        <div class="explore">
            <h2>Explore Pangkor</h2>
            <p>"Pulau Pangkor Bebas Cukai"</p>
        </div>
        <div class="weather-card">
            <div id="openweathermap-widget-11"></div>
            <script src='//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/d3.min.js'></script>
            <script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 11,cityid: '1763070',appid: 'e275ab309bd1d35b3a17022e298ae453',units: 'metric',containerid: 'openweathermap-widget-11',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
        </div>
        <div class="images">
            <div class="card">
                <h3>Teluk Nipah</h3>
                <a href="https://www.percutianbajet.com/perak/pulau-pangkor/teluk-nipah-pulau-pangkor" target="_blank"><img src="{{asset('img/teluk nipah.jpg')}}" alt=""></a>
            </div>
            <div class="card">
                <h3>Kota Belanda</h3>
                <a href="https://themalayapost.my/kota-belanda-monumen-popular-di-pulau-pangkor/" target="_blank"><img src="{{asset('img/kota belanda.jpg')}}" alt=""></a>
            </div>
            <div class="card">
                <h3>Island Hopping</h3>
                <a href="" target="_blank"><img src="{{asset('img/island hopping.jpg')}}" alt=""></a>
            </div>

        </div>
    </div>
</div>
<script src="{{asset('js/welcome.js')}}"></script>
<script>
     var slideUp = {
        distance: '150%',
        origin: 'bottom',
        opacity: null
    };
    ScrollReveal().reveal('.contents', {delay:300});

    function changepickup(){
        var pickup =  document.getElementById('pickup');
        let currentdate = new Date();
        let day = currentdate.getDate();
        let month = currentdate.getMonth()+1;
        let year = currentdate.getFullYear();
        let date = "{{$date}}";
        pickup.type = 'date';
        pickup.min = date;
    }
    function changereturn(){
        var pickup =  document.getElementById('return');
        let date = "{{$date}}";
        pickup.type = 'date';
        pickup.min = date;
    }
</script>
@endsection
