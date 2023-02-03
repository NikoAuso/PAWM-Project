<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Eventi;
use Illuminate\Http\RedirectResponse;

/**
 * This controller is responsible for managing restricted area
 * control for ADMIN level users ONLY and uses a simple
 * feature to include behavior.
 */
class EventController extends Controller
{
    /**
     * @var Eventi
     */
    protected Eventi $eventModel;

    /**
     * Constructor to initialize the variable
     */
    public function __construct()
    {
        $this->eventModel = new Eventi();
    }

    //EVENTI

    /**
     * Update an event in the database and redirect to the "all events" page
     *
     * @param EventRequest $request
     * @param int $id
     * @return RedirectResponse
     * @see Eventi::modificaEvento()
     */
    public function modificaEvento(EventRequest $request, int $id): RedirectResponse
    {
        if (Eventi::getEvento($id)->first() === null)
            return redirect()
                ->route('lv_a.events.display')
                ->withErrors('L\'evento non esiste');
        $this->eventModel->modificaEvento($request, $id);
        return redirect()
            ->route('lv_a.events.display')
            ->with('message', 'Evento modificato');
    }

    /**
     * Insert an event in the database and redirect to the "all events" page
     *
     * @param EventRequest $request
     * @return RedirectResponse
     * @see Eventi::inserisciEvento()
     */
    public function inserisciEvento(EventRequest $request): RedirectResponse
    {
        $this->eventModel->inserisciEvento($request);
        return redirect()
            ->route('lv_a.events.display')
            ->with('message', 'Evento salvato');
    }

    /**
     * Delete (NOT DEFINITLY) an event from the database and redirect to the "all events" page
     *
     * @param int $id
     * @return RedirectResponse
     * @see Eventi::eliminaEvento()
     */
    public function eliminaEvento(int $id): RedirectResponse
    {
        if (Eventi::getEvento($id)->first() === null)
            return redirect()
                ->route('lv_a.events.display')
                ->withErrors('L\'evento non esiste');
        $this->eventModel->eliminaEvento($id);
        return redirect()
            ->route('lv_a.events.display')
            ->with('message', 'Evento eliminato');
    }

    /**
     * Delete (DEFINITELY) an event from the database and redirect
     *
     * @param int $id
     * @return RedirectResponse
     * @see Eventi::deleteDefinitely()
     */
    public function eliminaDefinitivamenteEvento(int $id): RedirectResponse
    {
        if (Eventi::getEvento($id)->first() === null)
            return redirect()
                ->route('lv_a.events.display')
                ->withErrors('L\'evento non esiste');
        elseif (Eventi::getEvento($id)->first()->deleted === 0)
            return redirect()
                ->route('lv_a.events.display')
                ->withErrors('Impossibile eliminare definitivamente l\'evento. L\'evento non è mai stato "eliminato"');
        $this->eventModel->deleteDefinitely($id);
        return redirect()
            ->route('lv_a.events.deleted')
            ->with('message', 'Evento eliminato definitivamente');
    }

    /**
     * Restore an event (NOT DEFINITLY DELETED) from the database and redirect
     *
     * @param int $id
     * @return RedirectResponse
     * @see Eventi::restoreEvent()
     */
    public function ripristinaEvento(int $id): RedirectResponse
    {
        if (Eventi::getEvento($id)->first() === null)
            return redirect()
                ->route('lv_a.events.display')
                ->withErrors('L\'evento non esiste');
        elseif (Eventi::getEvento($id)->first()->deleted === 0)
            return redirect()
                ->route('lv_a.events.display')
                ->withErrors('Impossibile ripristinare definitivamente l\'evento. L\'evento non è mai stato eliminato');
        $this->eventModel->restoreEvent($id);
        return redirect()->route('lv_a.events.deleted')
            ->with('message', 'Evento ripristinato');
    }
}
