<?php

namespace App\Models;

use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * App\Models\User
 *
 * @property mixed $name
 * @property mixed $surname
 * @property mixed $username
 * @property mixed $email
 * @property mixed $password
 * @property mixed $role
 * @property mixed $zona
 * @property mixed $team
 * @property mixed $avatar
 * @property mixed $lastaccess
 * @property mixed $updated_by
 * @property int $id
 * @property int $email_verified
 * @property string|null $remember_token
 * @property string|null $series_id
 * @property string|null $expires
 * @property string|null $phone
 * @property string|null $account_facebook
 * @property string|null $account_instagram
 * @property string|null $address
 * @property string|null $birthday
 * @property int $active
 * @property int $deleted
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * @var string
     */
    protected $table = 'users';
    /**
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * @var bool
     */
    public $incrementing = true;
    /**
     * @var string
     */
    protected $keyType = 'int';
    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'email',
        'password',
        'role',
        'team',
        'avatar',
        'phone',
        'account_facebook',
        'account_instagram',
        'address',
        'birthday',
        'lastaccess',
        'active',
        'deleted',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'series_id' .
        'expires'
    ];

    /**
     * @return Collection|array
     */
    public static function getPRUser(): Collection|array
    {
        return User::query()
            ->where('role', 'user')
            ->where('deleted', false)
            ->orderBy('username', 'ASC')
            ->get();
    }

    /**
     * @return Collection|array
     */
    public static function getAdminUser(): Collection|array
    {
        return User::query()
            ->where('role', 'admin')
            ->where('deleted', false)
            ->orderBy('username', 'ASC')
            ->get();
    }

    /**
     * @return Collection|array
     */
    public static function getInactiveUsers(): Collection|array
    {
        return User::all()
            ->where('active', false);
    }

    /**
     * @return array|Collection
     */
    public static function getDeletedUsers(): array|Collection
    {
        return User::all()
            ->where('deleted', true);
    }

    /**
     * @param $id
     * @return array|Collection
     */
    public static function getUserById($id): array|Collection
    {
        return User::all()
            ->where('id', $id);
    }

    /**
     * @param $username
     * @return Collection|array
     */
    public static function getUserByUsername($username): Collection|array
    {
        return User::all()
            ->where('username', $username);
    }

    /**
     * @param UserRequest $request
     * @return void
     */
    public function insertUser(UserRequest $request): void
    {
        User::query()
            ->create([
                'avatar' => 'profile-' . rand(1, 6) . '.webp',
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => Hash::make('Mamateam2022!'),
                'role' => $request->role,
                'team' => $request->team,
                'active' => $request->boolean('active'),
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]);
    }

    /**
     * @param UserRequest $request
     * @param $id
     * @return void
     */
    public function editUser(UserRequest $request, $id): void
    {
        User::query()
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
                'team' => $request->team,
                'active' => $request->boolean('active')
            ]);
    }

    /**
     * @param $id
     * @return void
     */
    public function deleteUser($id): void
    {
        User::query()
            ->where('id', $id)
            ->update([
                'active' => false,
                'deleted' => true
            ]);
    }

    /**
     * @param $id
     * @return void
     */
    public function definitelyDeleteUser($id): void
    {
        User::query()
            ->where('id', $id)
            ->delete();
    }

    /**
     * @param $id
     * @return void
     */
    public function restoreUser($id): void
    {
        User::query()
            ->where('id', $id)
            ->update([
                'active' => false,
                'deleted' => false
            ]);
    }
}
