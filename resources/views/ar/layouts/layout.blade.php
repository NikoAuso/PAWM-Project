<!doctype html>
<!--[if IE 7 ]> <html lang="it" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]> <html lang="it" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]> <html lang="it" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script type="text/plain" cookie-consent="tracking" async src="https://www.googletagmanager.com/gtag/js?id=UA-159245877-2"></script>
    <script type="text/plain" cookie-consent="tracking">
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-159245877-2');
        </script>
    <!-- end of Google Analytics-->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Nicolo' Ausili">
    <meta name="keywords" content="Mamateam, Mamamia, Miami, Noir, Celeste, Dopestaff, discoteca, eventi">
    <meta name="description" content="Tutte le informazione degli eventi in programma al Mamamia, Miami e Noir le trovi qui. Che cosa aspetti? Entra!" />
    <!--[if lt IE 9]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Styles -->
    <link href="{{asset('assets/bootstrap/css/sb-admin-pro.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    @yield('link')
</head>
<body class="nav-fixed">
@include('ar.layouts.navbar.topbar')
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
    @include('ar.layouts.navbar.navbar')
    </div>
    <div id="layoutSidenav_content">
        <main>
        @yield('content')
        </main>
        <footer class="footer-admin mt-auto footer-light">
            <div class="container-xl px-4">
                <div class="row">
                    <div class="col-md-6 small">Copyright &#169; {{date("Y")}}</div>
                    <div class="col-md-6 text-md-end small">
                        <!--<a href="#!">Privacy Policy</a>&middot;<a href="#!">Terms &amp; Conditions</a>-->
                        Versione {{config('app.version')}}
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- JQuery core JavaScript-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap/js/sb-admin-pro.js')}}"></script>
<script type="text/javascript" src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!-- Scripts-->
@yield('scripts')
</body>
</html>