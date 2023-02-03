@php use App\Models\Eventi; @endphp
@php use App\Models\User;use Carbon\Carbon; @endphp
@extends('../../ar/layouts/layout')

@section('title', 'Admin | Liste')
@section('content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="list"></i></div>
                            Liste eliminate
                        </h1>
                        Liste eliminate &middot; {{$lists->count()}} totali
                    </div>
                </div>
            </div>
        </div>
    </header>
    @include('ar.layouts.message')
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <div class="row">
            <div class="col-xl-12 col-sm-12 mb-12">
                <div class="card mb-4 mt-2">
                    <div class="card-header">
                        Tutte le liste eliminate
                    </div>
                    <div class="card-body">
                        @if(!count($lists))
                            <div class="card-text text-center">Nessuna lista eliminata</div>
                        @else
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-4 g-4">
                                @foreach($lists as $list)
                                    @php($event = Eventi::getEvento($list->event_id)->first())
                                    <div class="col">
                                        <div class="card h-100">
                                            <div class="card-header text-center">
                                                {{$event->titolo}}@if($event->date)
                                                    - {{Carbon::parse($event->date)->format('d/m/Y')}}
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <h3 class="card-title"><strong>{{$list->name}} {{$list->surname}}</strong></h3>
                                                <h6 class="card-subtitle mb-2 text-muted">
                                                    {{User::getUserById($list->fatto_da)->values()->get(0)->username}}
                                                </h6>
                                                <p class="card-text">
                                                    <span>Persone nella lista: {{$list->quantity}}</span>
                                                </p>
                                            </div>
                                            <div class="card-footer text-center">
                                                <a class="btn btn-primary mb-2"
                                                   href="{{route('lv_a.events.edit', $list->event_id)}}"
                                                   role="button" data-bs-toggle="edit-modal"
                                                   data-bs-target="#exampleModal">
                                                    Evento
                                                </a>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a class="btn btn-success mb-2 restore-btn"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#restore-modal"
                                                       data-link="{{route('lv_a.lists.restore', $list->list_id)}}"
                                                       data-descrizione="Vuoi ripristinare la lista <strong>{{$list->name}} {{$list->surname}}</strong>?"
                                                       role="button">
                                                        <i class="fas fa-trash-restore"></i>
                                                    </a>
                                                    <a class="btn btn-danger mb-2 delete-btn"
                                                       data-link="{{route('lv_a.lists.def_delete', $list->list_id)}}"
                                                       data-descrizione="Vuoi eliminare <strong>DEFINITIVAMENTE</strong>
                                                       la lista <strong>{{$list->name}} {{$list->surname}}</strong>?"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#delete-modal"
                                                       role="button">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Restore Confirmation Modal -->
    <div class="modal fade" id="restore-modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Conferma</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form action="" method="GET" id="restoreForm">
                    <div class="modal-body">
                        <p id="descrizione"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Si</button>
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">No
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Conferma</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form action="" method="GET" id="deleteForm">
                    <div class="modal-body">
                        <p id="descrizione"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Si</button>
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">No
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on('click', '.restore-btn', function () {
            let link = $(this).data('link');
            let descrizione = $(this).data('descrizione');
            $('#restoreForm').attr('action', link);
            $('#restoreForm #descrizione').html(descrizione);
        });
        $(document).on('click', '.delete-btn', function () {
            let link = $(this).data('link');
            let descrizione = $(this).data('descrizione');
            $('#deleteForm').attr('action', link);
            $('#deleteForm #descrizione').html(descrizione);
        });
    </script>
@endsection
