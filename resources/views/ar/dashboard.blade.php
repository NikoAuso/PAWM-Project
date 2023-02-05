@extends('ar/layouts.layout')

@section('title', 'Dashboard')
@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            Dashboard
                        </h1>
                        <div class="page-header-subtitle">Comandi principali</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container mt-n10">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 mb-4">
                <div class="card h-100">
                    <div class="card-body h-100 p-5">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-xxl-8">
                                <div class="text-left text-xl-start text-xxl-left mb-4 mb-xl-0 mb-xxl-4">
                                    <h1 class="text-primary">Benvenuti nell'area riservata!</h1>
                                    <p class="text-gray-700 mb-0">Novità dell'aggiornamento {{config('app.version')}}</p>
                                    <ul>
                                        <li>Gestione liste</li>
                                        <li>Gestione membri delle liste</li>
                                        <li>Risoluzione bug</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-4 col-xxl-4 text-center">
                                <img class="img-fluid" src="{{asset('assets/img/illustrations/at-work.svg')}}" style="max-width: 26rem"  alt=""/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-3">
                                <div class="text-white-75 small">Utenti</div>
                                <div class="text-lg font-weight-bold">{{$allUser}} Pr registrati</div>
                                <div class="text-lg font-weight-bold">{{$inactiveUser}} Pr non attivi</div>
                            </div>
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('users.pr')}}">Vedi dettagli</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-3">
                                <div class="text-white-75 small">Eventi</div>
                                <div class="text-lg font-weight-bold">{{$allEvents}} Eventi</div>
                                <div class="text-lg font-weight-bold">{{$deletedEvents}} Eliminati</div>
                            </div>
                            <i class="fa fa-table fa-5x"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('events')}}">Vedi dettagli</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-3">
                                <div class="text-white-75 small">Liste</div>
                                <div class="text-lg font-weight-bold">{{$allListe}} Liste</div>
                            </div>
                            <i class="fa-solid fa-list-check fa-5x"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('liste')}}">Vedi dettagli</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-3">
                                <div class="text-white-75 small">Tavoli</div>
                                <div class="text-lg font-weight-bold">{{$allTavoli}} Tavoli</div>
                            </div>
                            <i class="fas fa-glass-martini-alt fa-5x"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('tavoli')}}">Vedi dettagli</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main page-->
@endsection
