<?php

namespace App\Http\Controllers;

use App\Models\Eventi;
use App\Models\Liste;
use App\Models\Tavoli;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/**
 * This is the controller that manage the home page of the website.
 */
class DashboardController extends Controller
{
    /**
     * @var User
     */
    protected User $userModel;

    /**
     * @var Eventi
     */
    protected Eventi $eventModel;

    /**
     * @var Liste
     */
    protected Liste $listeModel;

    /**
     * @var Tavoli
     */
    protected Tavoli $tavoliModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userModel = new User();
        $this->eventModel = new Eventi();
        $this->listeModel = new Liste();
        $this->tavoliModel = new Tavoli();
    }
    public function index(): Application|Factory|View|RedirectResponse
    {
        if(Auth::user()->getRoleNames()->get(0) == 'admin') {
            $data = [
                'allUser' => $this->userModel->all()->count(),
                'inactiveUser' => $this->userModel->getInactiveUsers()->count(),
                'allEvents' => $this->eventModel->all()->count(),
                'deletedEvents' => $this->eventModel->getDeletedEvents()->count(),
                'allListe' => $this->listeModel->all()->count(),
                'allTavoli' => $this->tavoliModel->all()->count()
            ];
            return view('ar/dashboard')
                ->with($data);
        }elseif (Auth::user()->getRoleNames()->get(0) == 'pr'){
            $data = [
                'allListe' => $this->listeModel->getListByUserId(Auth::id())->count(),
                'allTavoli' => $this->tavoliModel->getTavoloByUser(Auth::id())->count()
            ];
            return view('ar/dashboard')
                ->with($data);
        }else{
            return redirect()->back()->withErrors('Errore generico');
        }
    }

}
