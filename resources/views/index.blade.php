@extends('layouts.layouts')

@section('title')
    Mamateam/Celeste - Sito ufficiale
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.css"/>
@endsection

@section('content')
    <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="0" class="scrollspy-example" tabindex="0">
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    @include('layouts.home.navbar')

    <!-- Video Background -->
    <div id="videoContainer">
        <div
            class="container-fluid d-flex justify-content-center align-items-center align-content-center video-parallax-container"
            id="home">
            <div class="row">
                <div class="col-12">
                    <img id="logoImg" class="img-fluid" src="{{asset('assets/img/logo.png')}}"
                         alt="logo"
                         data-aos="fade-down" data-aos-duration="1000" data-aos-delay="3000">
                </div>
            </div>
            <video id="videoIntro" class="filter" autoplay loop muted preload="auto">
                <source src="{{asset('assets/vid/videoplayback.mp4')}}" type="video/mp4">
                <source src="{{asset('assets/vid/videoplayback.webm')}}" type="video/webm">
                <source src="{{asset('assets/vid/videoplayback.ogg')}}" type="video/ogg">
            </video>
        </div>
    </div>

    <!--Main-->
    <div id="wrapper">
        @include('layouts.home.event_display')

        @include('layouts.home.history')

        @include('layouts.home.team')

        <div style="height: 25vh"></div>

        <!-- Galleria
        <div class="container" id="galleria">
            <div class="col-sm-12">
                <h2 class="title text-center" data-aos="fade-down" data-aos-delay="200" data-aos-duration="700">GALLERIA</h2>
                <div id="showcase" class="noselect" data-aos="zoom-down" data-aos-delay="400" data-aos-duration="700"></div>
                <p id="item-title" data-aos="zoom-down" data-aos-delay="400" data-aos-duration="700"></p>
            </div>
        </div>-->

        <div class="clearfix"></div>

        @include('layouts.home.footer')
    </div>
    </body>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
            integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
            crossorigin="anonymous"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript" src="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.js" defer></script>

    <script type="text/javascript" src="{{asset('assets/js/home/script.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/home/jquery.reflection.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/home/jquery.cloud9carousel.js')}}"></script>

    <!-- Other -->
    <script type="text/javascript">
        AOS.init();
        $(document).ready(function () {
            setTimeout(function () {
                $('body').addClass('loaded');
                setTimeout(function () {
                    $('#navbar').css('display', 'block');
                }, 800);
            }, 3000);
        });
        // Scrolling Effect
        $(window).scroll(function () {
            $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
        });
    </script>
@endsection
