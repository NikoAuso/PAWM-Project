<?php

namespace App\Models;

use App\Http\Requests\ListeRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Includes all the method to manage the events in the database
 *
 */
class Liste extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $incrementing = true;
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = 'liste';
    /**
     * @var string
     */
    protected $primaryKey = 'list_id';
    /**
     * @var string
     */
    protected $keyType = 'int';
    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var string[]
     */
    protected $fillable = [
        'event_id',
        'name',
        'surname',
        'quantity',
        'entered',
        'fatto_da',
    ];

    /**
     * Gets all the available events from the database.
     *
     * @return array|Collection
     */
    public static function getLists(): array|Collection
    {
        return Liste::query()
            ->join('events as events', 'events.id', '=', 'liste.event_id')
            ->where('events.deleted', false)
            ->where('events.isJolly', false)
            ->where('liste.deleted', false)
            ->orderBy('events.date', 'desc')
            ->get();
    }

    /**
     * Gets all the deleted events from the database.
     *
     * @param int $id
     * @return Collection|array
     */
    public static function getListByEventId(int $id): Collection|array
    {
        return Liste::query()
            ->join('events as events', 'events.id', '=', 'liste.event_id')
            ->where('event_id', $id)
            ->where('events.deleted', false)
            ->where('events.isJolly', false)
            ->where('liste.deleted', false)
            ->orderBy('liste.surname', 'asc')
            ->get();
    }

    /**
     * @param ListeRequest $request
     * @return void
     */
    public function insert_lista(ListeRequest $request): void
    {
        $request->validate([
            'event_id' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'quantity' => 'required',
            'entered' => 'nullable',
            'fatto_da' => 'required'
        ]);
        Liste::query()
            ->insert([
                'event_id' => $request->event_id,
                'name' => $request->name,
                'surname' => $request->surname,
                'quantity' => $request->quantity,
                'entered' => 0,
                'fatto_da' => $request->fatto_da,
                'created_by' => Auth::id()
            ]);
    }

    /**
     * @param ListeRequest $request
     * @return void
     */
    public function edit_lista(ListeRequest $request): void
    {
        Liste::query()
            ->where('list_id', $request->list_id)
            ->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'quantity' => $request->quantity,
                'entered' => $request->entered,
                'fatto_da' => $request->fatto_da
            ]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete_lista(int $id): void
    {
        Liste::query()
            ->where('list_id', $id)
            ->update([
                'deleted' => true
            ]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function restore_lista(int $id): void
    {
        Liste::query()
            ->where('list_id', $id)
            ->update([
                'deleted' => false
            ]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function definitely_delete_lista(int $id): void
    {
        Liste::query()
            ->where('list_id', $id)
            ->delete();
    }
}