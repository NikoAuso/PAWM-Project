<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * This controller is responsible for managing restricted area
 * control for ADMIN level users ONLY and uses a simple
 * feature to include behavior.
 */
class UserController extends Controller
{
    /**
     * @var User
     */
    protected User $userModel;

    /**
     * Constructor to initialize the variable
     */
    public function __construct()
    {
        $this->userModel = new User();
    }

    //UTENTI

    /**
     * Function that insert new user and redirect to the page depending on the last page viewed
     *
     * @param UserRequest $request
     * @param $page
     * @return RedirectResponse
     */
    public function inserisciUtente(UserRequest $request, $page): RedirectResponse
    {
        $this->userModel->insertUser($request);
        $page_final = match ($page) {
            'user' => 'lv_a.user.user',
            'admin' => 'lv_a.user.admin'
        };
        return redirect()->route($page_final)
            ->with('message', 'Utente inserito. La password di default è impostata a "Mamateam2022!"');
    }

    /**
     * Function that edit the user selected by id and redirect to the page depending on the last page viewed
     *
     * @param UserRequest $request
     * @param $id
     * @param $page
     * @return RedirectResponse
     */
    public function modificaUtente(UserRequest $request, $id, $page): RedirectResponse
    {
        if ($id == 1 || $id == Auth::id())
            return abort(401, 'Utente non modificabile');
        $this->userModel->editUser($request, $id);
        $page_final = match ($page) {
            'user' => 'lv_a.user.user',
            'admin' => 'lv_a.user.admin'
        };
        return redirect()->route($page_final)
            ->with('message', 'Utente modificato');
    }

    /**
     * Function that deactivate the user selected by id and redirect to the page depending on the last page viewed
     *
     * @param $id
     * @param $page
     * @return RedirectResponse
     */
    public function eliminaUtente($id, $page): RedirectResponse
    {
        $page_final = match ($page) {
            'user' => 'lv_a.user.user',
            'admin' => 'lv_a.user.admin'
        };
        if (User::query()->where('id', $id)->exists()) {
            $this->userModel->deleteUser($id);
            return redirect()->route($page_final)
                ->with('message', 'Utente non più attivo');
        } else {
            return redirect()->route($page_final)
                ->withErrors('L\'utente non esiste');
        }
    }

    /**
     * Function that definitely delete the user selected by id and redirect to the "deleted user" page
     *
     * @param $id
     * @return RedirectResponse
     */
    public function eliminaDefinitivamenteUtente($id): RedirectResponse
    {
        if (User::query()->where('id', $id)->exists()) {
            $this->userModel->definitelyDeleteUser($id);
            return redirect()->route('lv_a.user.deleted')
                ->with('message', 'Utente eliminato definitivamente');
        } else {
            return redirect()->route('lv_a.user.deleted')
                ->withErrors('L\'utente non esiste');
        }
    }

    /**
     * Function that restore the user selected by id and redirect to the "deleted user" page
     *
     * @param $id
     * @return RedirectResponse
     */
    public function ripristinaUtente($id): RedirectResponse
    {
        if (User::query()->where('id', $id)->exists()) {
            $this->userModel->restoreUser($id);
            return redirect()->route('lv_a.user.deleted')
                ->with('message', 'Utente ripristinato');
        } else {
            return redirect()->route('lv_a.user.deleted')
                ->withErrors('L\'utente non esiste');
        }
    }
}
