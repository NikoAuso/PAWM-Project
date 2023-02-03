<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ListeController;
use App\Http\Controllers\Admin\TavoliController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Requests\ListeSearchRequest;
use App\Http\Requests\TavoloSearchRequest;
use App\Models\Eventi;
use App\Models\Liste;
use App\Models\Tavoli;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event_{id}', [HomeController::class, 'single_event'])->name('singleEvent');

Route::group(['prefix' => 'ar/', 'middleware' => ['auth', 'verified']], function () {
    //Admin
    Route::group(['prefix' => 'lv_a/', 'as' => 'lv_a.', 'middleware' => ['can:isAdmin']], function () {
        Route::get('dashboard', function () {
            return view('ar/lv_a/dashboard');
        })->name('dashboard');

        //Logs
        Route::get('logs', [LogViewerController::class, 'index'])->name('logs');

        //Gestione utenti
        Route::group(['prefix' => 'utenti/', 'as' => 'user.'], function () {
            Route::post('insert/{page}', [UserController::class, 'inserisciUtente'])->name('insert_save');
            Route::post('edit/{id}/{page}', [UserController::class, 'modificaUtente'])->name('edit_save');
            Route::get('delete/{id}/{page}', [UserController::class, 'eliminaUtente'])->name('delete_save');
            Route::get('def_delete/{id}', [UserController::class, 'eliminaDefinitivamenteUtente'])->name('definitely_delete');
            Route::get('restore/{id}', [UserController::class, 'ripristinaUtente'])->name('restore');

            Route::get('user', function () {
                $users = User::getPRUser()->values();
                return view('ar/lv_a/users/users_display')
                    ->with('users', $users)
                    ->with('title', 'PR semplici');
            })->name('user');
            Route::get('admin', function () {
                $users = User::getAdminUser()->values();
                return view('ar/lv_a/users/users_display')
                    ->with('users', $users)
                    ->with('title', 'Amministratori');
            })->name('admin');
            Route::get('insert/{page}', function ($page) {
                return view('ar/lv_a/users/add_user')
                    ->with('page', $page);
            })->name('insert');
            Route::get('edit/{id}/{page}', function ($id, $page) {
                $data = User::getUserById($id)->first();
                if ($id == 1)
                    return abort(401, 'Utente non modificabile');
                elseif (empty($data))
                    abort(403, 'L\'utente non esiste!');
                return view('ar/lv_a/users/edit_user')
                    ->with('data', $data)
                    ->with('page', $page);
            })->name('edit');
            Route::get('deleted', function () {
                $users = User::getDeletedUsers()->values();
                return view('ar/lv_a/users/deleted_users_display')
                    ->with('users', $users)
                    ->with('title', 'PR eliminati');
            })->name('deleted');
            Route::get('profile_view/{id}', function ($id) {
                $user = User::getUserById($id)->first();
                if (empty($user))
                    abort(403, 'L\'utente non esiste!');
                return view('ar/profile/view_profile')
                    ->with('user', $user);
            })->name('profile');
        });

        //Gestione eventi
        Route::group(['prefix' => 'eventi/', 'as' => 'events.'], function () {
            Route::post('event/edit/{id}', [EventController::class, 'modificaEvento'])->name('edit_save');
            Route::post('event/insert', [EventController::class, 'inserisciEvento'])->name('insert_save');
            Route::get('event/delete/{id}', [EventController::class, 'eliminaEvento'])->name('delete');
            Route::get('event/delete_def/{id}', [EventController::class, 'eliminaDefinitivamenteEvento'])->name('definitely_delete');
            Route::get('event/restore/{id}', [EventController::class, 'ripristinaEvento'])->name('restore_delete');

            Route::get('all', function () {
                $events = Eventi::getEvents();
                $eventsNext = Eventi::getEventsNext();
                $eventsOld = Eventi::getEventsOld();
                $jollyEvents = Eventi::getEventsJolly();
                return view('ar/lv_a/event/events_display')
                    ->with('events', $events)
                    ->with('eventsNext', $eventsNext)
                    ->with('eventsOld', $eventsOld)
                    ->with('jollyEvents', $jollyEvents);
            })->name('display');
            Route::get('all_table', function () {
                $events = Eventi::getEvents();
                return view('ar/lv_a/event/events_listTable')
                    ->with('events', $events);
            })->name('table');
            Route::get('all_calendar', function () {
                $data = Eventi::getEvents();
                $dataEvent = array();
                foreach ($data as $event) {
                    if ($event->isJolly == "0")
                        $dataEvent = array_merge($dataEvent,
                            array(['id' => $event->id,
                                'title' => $event->titolo,
                                'extra' => $event->extra,
                                'date' => $event->date,
                                'dateDay' => Carbon::parse($event->date)->dayName,
                                'dateFull' => Carbon::parse($event->date)->format('d/m/Y'),
                                'dateHour' => Carbon::parse($event->date)->format('H:i'),
                                'discoteca' => $event->discoteca,
                                'descrizione' => ($event->descrizione == null) ? 'Descrizione non aggiunta' : $event->descrizione,
                                'immagine' => $event->image,
                                'allDay' => true])
                        );
                }
                $dataEvent = json_encode($dataEvent);
                return view('ar/lv_a/event/events_calendar')
                    ->with('data', $dataEvent)
                    ->with('events', $data);
            })->name('calendar');
            Route::get('event/edit/{id}', function ($id) {
                $data = Eventi::getEvento($id)->first();
                if ($data === null) {
                    return redirect()
                        ->route('lv_a.events.display')
                        ->withErrors('L\'evento non esiste');
                } else {
                    return view('ar/lv_a/event/event_modify', ['id' => $id])
                        ->with('data', $data);
                }
            })->name('edit');
            Route::get('event/insert', function () {
                return view('ar/lv_a/event/event_insert');
            })->name('insert');
            Route::get('event/deleted', function () {
                $events = Eventi::getDeletedEvents();
                return view('ar/lv_a/event/deleted_events_display')
                    ->with('deletedEvents', $events);
            })->name('deleted');
        });

        //Gestione tavoli e classifica
        Route::group(['prefix' => 'tavoli/', 'as' => 'tables.'], function () {
            Route::post('insert', [TavoliController::class, 'inserisciTavolo'])->name('insert');
            Route::post('update/{id}', [TavoliController::class, 'modificaTavolo'])->name('update');
            Route::get('delete/{id}', [TavoliController::class, 'eliminaTavolo'])->name('delete');
            Route::post('store_season', [TavoliController::class, 'chiudiStagione'])->name('store');

            Route::get('event/{id}', function ($id) {
                $table = Tavoli::getTavoliForEvent($id);
                $event = Eventi::getEvento($id)->first();
                return view('ar/lv_a/tavoli/table_display')
                    ->with('event', $event)
                    ->with('tables', $table);
            })->name('display_event');
            Route::get('all', function () {
                $table = Tavoli::getTavoli();
                return view('ar/lv_a/tavoli/all_table_display')
                    ->with('tables', $table);
            })->name('display_all');
            Route::post('filtered', function (TavoloSearchRequest $request) {
                $result = Tavoli::searchTavolo($request)->values();
                return view('ar/lv_a/tavoli/all_table_display')
                    ->with('tables', $result);
            })->name('search');
            Route::get('archivio', function () {
                $result = DB::table('archivio_tavoli')->get()->values();
                return view('ar/lv_a/tavoli/archivio')
                    ->with('archivio', $result);
            })->name('archivio');
            Route::get('leaderboard', function () {
                $result = Tavoli::query()
                    ->selectRaw('fattoDa, COUNT(*) as count')
                    ->groupBy('fattoDa')
                    ->orderBy('count', 'desc')
                    ->get()
                    ->values();
                $date = DB::table('events')
                    ->orderBy('date', 'DESC')
                    ->where('date', '<=', date(now()))
                    ->first();
                return view('ar/lv_a/tavoli/leaderboard')
                    ->with('result', $result)
                    ->with('date', $date);
            })->name('leaderboard');
        });

        //Gestione liste
        Route::group(['prefix' => 'liste/', 'as' => 'lists.'], function () {
            Route::get('all', function () {
                $lists = Liste::getLists();
                return view('ar/lv_a/liste/lists_rel_display')
                    ->with('lists', $lists);
            })->name('all');
            Route::get('event/{id}', function (int $id) {
                $event = Eventi::getEvento($id)->first();
                if ($event) {
                    $lists = Liste::getListByEventId($id);
                    return view('ar/lv_a/liste/lists_rel_display_event')
                        ->with('lists', $lists)
                        ->with('event', $event);
                } else {
                    abort(403, 'L\'evento non esiste');
                }
            })->name('event');
            Route::post('search', function (ListeSearchRequest $request) {
                $result = Liste::getListByEventId($request->evento)->values();
                return view('ar/lv_a/liste/lists_rel_display')
                    ->with('lists', $result);
            })->name('search');
            Route::get('deleted', function () {
                $lists = Liste::query()
                    ->where('deleted', true)
                    ->get();
                return view('ar/lv_a/liste/deleted_lists_rel_display')
                    ->with('lists', $lists);
            })->name('deleted');

            Route::post('insert', [ListeController::class, 'insert_lista'])->name('insert');
            Route::post('edit/{id}', [ListeController::class, 'edit_lista'])->name('edit');
            Route::get('delete/{id}', [ListeController::class, 'delete_lista'])->name('delete');
            Route::get('restore/{id}', [ListeController::class, 'restore_lista'])->name('restore');
            Route::get('def_delete/{id}', [ListeController::class, 'definitely_delete_lista'])->name('def_delete');
        });
    });

//User
    Route::get('ar/lv_u/dashboard', function () {
        return view('ar/lv_u/dashboard');
    })->name('lv_u.dashboard');

//Gestione profilo personale
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/update-profile', [ProfileController::class, 'modifyData'])->name('profile_update');
    Route::post('profile/update-social', [ProfileController::class, 'modifyDataSocial'])->name('profile_update_social');
    Route::post('profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile_uploadAvatar');
    Route::get('profile/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('profile_deleteAvatar');
    Route::get('security', [ProfileController::class, 'mostraSecurity'])->name('security');
    Route::post('security/password-modify', [ProfileController::class, 'passwordChange'])->name('security_change');
});
