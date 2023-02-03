<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListeRequest;
use App\Models\Liste;
use Illuminate\Http\RedirectResponse;

/**
 * This controller is responsible for managing restricted area
 * control for ADMIN level users ONLY and uses a simple
 * feature to include behavior to manage lists of the events.
 */
class ListeController extends Controller
{
    /**
     * @var Liste
     */
    protected Liste $listModel;

    /**
     * Constructor to initialize the variable
     */
    public function __construct()
    {
        $this->listModel = new Liste();
    }

    /**
     * @param ListeRequest $request
     * @return RedirectResponse
     */
    public function insert_lista(ListeRequest $request): RedirectResponse
    {
        $this->listModel->insert_lista($request);
        return redirect()->back()
            ->with('message', 'Lista aggiunta');
    }

    /**
     * @param ListeRequest $request
     * @return RedirectResponse
     */
    public function edit_lista(ListeRequest $request): RedirectResponse
    {
        $this->listModel->edit_lista($request);
        return redirect()->back()
            ->with('message', 'Lista modificata');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete_lista(int $id): RedirectResponse
    {
        $this->listModel->delete_lista($id);
        return redirect()->back()
            ->with('message', 'Lista eliminata');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function restore_lista(int $id): RedirectResponse
    {
        $this->listModel->restore_lista($id);
        return redirect()->route('lv_a.lists.deleted')
            ->with('message', 'Lista ripristinata');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function definitely_delete_lista(int $id): RedirectResponse
    {
        $this->listModel->definitely_delete_lista($id);

        return redirect()->route('lv_a.lists.deleted')
            ->with('message', 'Lista eliminata definitivamente');
    }
}
