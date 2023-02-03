<!doctype html>
<!--[if IE 7 ]> <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]> <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]> <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Cookie Consent by https://www.CookieConsent.com -->
    <script type="text/javascript" src="//www.cookieconsent.com/releases/4.0.0/cookie-consent.js"
            charset="UTF-8"></script>
    <script type="text/javascript" charset="UTF-8">
        document.addEventListener('DOMContentLoaded', function () {
            cookieconsent.run({
                "notice_banner_type": "simple",
                "consent_type": "express",
                "palette": "dark",
                "language": "it",
                "page_load_consent_levels": ["strictly-necessary"],
                "notice_banner_reject_button_hide": false,
                "preferences_center_close_button_hide": false,
                "website_name": "Mamateam/Celeste"
            });
        });
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script type="text/plain" cookie-consent="tracking" async
            src="https://www.googletagmanager.com/gtag/js?id=UA-159245877-2"></script>
    <script type="text/plain" cookie-consent="tracking">
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-159245877-2');


    </script>
    <!-- end of Google Analytics-->

    <noscript>ePrivacy and GPDR Cookie Consent by <a href="https://www.CookieConsent.com/" rel="nofollow noopener">Cookie
            Consent</a></noscript>
    <!-- End Cookie Consent by https://www.CookieConsent.com -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="author" content="Nicolo' Ausili"/>
    <meta name="keywords" content="Mamateam, Mamamia, Miami, Noir, Celeste, Dopestaff, discoteca, eventi"/>
    <meta name="description"
          content="Tutte le informazione degli eventi in programma al Mamamia, Miami e Noir le trovi qui. Che cosa aspetti? Entra!"/>
    <!--[if lt IE 9]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>Mamateam/Celeste - Area riservata</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/img/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('assets/img/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('assets/css/login.style.css')}}">
    <link rel="stylesheet" href="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.css"/>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="navbar">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Mamateam') }}</a>
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left links -->
                <ul class="navbar-nav ms-auto align-items-right">
                    <li class="nav-item">
                        <a class="nav-link active mx-2" aria-current="page" href="{{route('home')}}"><span>Home</span></a>
                    </li>
                    <li class="nav-item ms-1">
                        <a class="btn btn-primary btn-rounded" role="button"
                           href="{{route('login')}}">Login</a>
                    </li>
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    @yield('content')

    <!-- JQuery core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.js" defer></script>
</body>
</html>

