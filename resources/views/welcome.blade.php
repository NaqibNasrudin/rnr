@extends('navbar')

<link rel="stylesheet" href="{{asset('css/welcome.css')}}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

@section('content')
<div class="header" id="header">
    <div class="text" id="text">
        <h1>R&R@Pangkor</h1>
        <p>Search and rent your best ride to roam around <span>Pangkor</span></p>
    </div>
    <img src="{{asset('img/bg.jpg')}}" alt="" id="bg">
    <img src="{{asset('img/moto.png')}}" alt="" id="moto">
    <a href="#brands"><ion-icon name="arrow-down-outline" id="icon" onclick="showContent()"></ion-icon></a>
</div>


{{-- <div class="custom-shape-divider-bottom-1668163191">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
    </svg>
</div> --}}


<div class="content" id="brands">
    <div class="brand" >
        <div class="brandlogo">
            {{-- <a href=""><img src="{{asset('img/yamaha.jpg')}}" alt=""></a>
            <a href=""><img src="{{asset('img/honda.png')}}" alt=""></a>
            <a href=""><img src="{{asset('img/sym.png')}}" alt=""></a> --}}
            <form action="" style="display: flex" method="POST">
                @csrf
                <div class="pickup">
                    <label for="">Pickup Date : </label>
                    <input type="date">
                </div>
                <div class="return">
                    <label for="">Return Date : </label>
                    <input type="date">
                </div>

                <input type="submit" class="submit">
            </form>
        </div>

    </div>
    <br>
    <div class="info">
    </div>
    <div class="steps">
        <p>HOW IT WORKS?</p>
        <h2>3 Simple Steps to Rent Your Best Bike.</h2>
        <div class="stepsdetail">
            <h2><ion-icon name="search"></ion-icon><br> Search</h2>
            <img src="{{asset('img/rotated-right-arrow.png')}}" alt="">
            <h2><ion-icon name="lock-open"></ion-icon><br> Book</h2>
            <img src="{{asset('img/rotated-right-arrow.png')}}" alt="">
            <h2><ion-icon name="alarm"></ion-icon><br> Pickup</h2>
        </div>
    </div>
    <div class="para">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, similique. Consectetur, eum odit vel autem architecto tempore! Officiis corporis, ratione minus facilis autem sequi, quae aliquam porro ipsam nisi ipsa tempora, quaerat magni. Natus molestiae dicta aliquam necessitatibus inventore velit esse eius, porro, cupiditate alias at, explicabo harum. Iusto, veniam corrupti? Maiores beatae tenetur cupiditate. Nisi, reiciendis earum! Pariatur officia nulla obcaecati porro maiores labore laudantium corporis aperiam, esse consequatur repudiandae inventore vero voluptates illum perferendis numquam eaque cupiditate omnis perspiciatis ullam doloremque. Debitis animi dolorum itaque quas ut necessitatibus maiores odio, eum omnis placeat nulla a suscipit aspernatur cum accusamus earum culpa temporibus. Quas voluptatem dolore dolorum iste et, non rerum fugit facilis expedita voluptates adipisci distinctio autem, reiciendis laborum? Odit laboriosam, inventore labore ipsa ipsum fuga aliquam. Minus quo similique illo nobis! Quibusdam dolorum repellendus sunt molestias quisquam quis doloribus minima? Ipsam quisquam rerum doloribus consectetur delectus, harum eveniet vitae! Ab quos soluta placeat. Excepturi debitis laudantium reiciendis! Quisquam libero molestias placeat quaerat iure harum tempore illo ullam perspiciatis eius ab neque voluptatum minus minima voluptatem quasi at repellendus tenetur vero eveniet possimus, obcaecati exercitationem? Aliquid aperiam a aliquam ipsam consequatur soluta ipsum adipisci voluptatibus voluptate harum, minima obcaecati at exercitationem vitae mollitia iure. Itaque non dolores modi maxime, voluptatibus, nam aliquam recusandae consequuntur reprehenderit asperiores, corrupti suscipit blanditiis in laudantium sit. Iusto repellendus eveniet maxime? Nam quae iure tempore ea quam deserunt temporibus ad tempora a illo quibusdam repellat fugit ipsam molestiae id iste dolorum officia obcaecati vitae, sequi, eius quis unde impedit. Minus nobis perferendis voluptate nisi! Aspernatur sed iste rem earum vero a natus explicabo. Ex reprehenderit dolorem dolor sed incidunt consequuntur quas, doloremque aut odio provident, blanditiis consectetur veritatis repellat laborum repudiandae corrupti quidem excepturi fuga dolores minima earum ipsam. Eos eligendi facilis quam!</p>
    </div>
</div>

<div class="weather-card">
    <div id="openweathermap-widget-11"></div>
    <script src='//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/d3.min.js'></script>
    <script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 11,cityid: '1763070',appid: 'e275ab309bd1d35b3a17022e298ae453',units: 'metric',containerid: 'openweathermap-widget-11',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
</div>

<script src="{{asset('js/welcome.js')}}"></script>
@endsection
