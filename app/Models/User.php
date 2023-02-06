<?php

namespace App\Models;

use App\Http\Requests\UserRequest;
use App\Notifications\CustomResetPasswordNotification;
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
use Spatie\Permission\Traits\HasRoles;

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
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable, HasRoles;

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
     * @return array|Collection|null
     */
    public static function getPRUser(): Collection|array|null
    {
        return self::query()
            ->role('pr')
            ->where('deleted', false)
            ->orderBy('username', 'ASC')
            ->get();
    }

    /**
     * @return array|Collection|null
     */
    public static function getAdminUser(): Collection|array|null
    {
        return self::query()
            ->role('admin')
            ->where('deleted', false)
            ->orderBy('username', 'ASC')
            ->get();
    }

    /**
     * @return Collection|array
     */
    public static function getInactiveUsers(): Collection|array
    {
        return self::all()
            ->where('active', false);
    }

    /**
     * @return array|Collection
     */
    public static function getDeletedUsers(): array|Collection
    {
        return self::all()
            ->where('deleted', true);
    }

    /**
     * @param int $id
     * @return array|Collection
     */
    public static function getUserById(int $id): array|Collection
    {
        return self::all()
            ->where('id', $id);
    }

    /**
     * @param string $username
     * @return Collection|array
     */
    public static function getUserByUsername(string $username): Collection|array
    {
        return self::all()
            ->where('username', $username);
    }

    /**
     * @param UserRequest $request
     * @return void
     */
    public function create(UserRequest $request): void
    {
        $user = self::query()
            ->create([
                'avatar' => 'profile-' . rand(1, 6) . '.webp',
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => Hash::make('Mamateam2022!'),
                'team' => $request->team,
                'active' => $request->boolean('active'),
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]);
        $user->assignRole($request->role);
    }

    /**
     * @param UserRequest $request
     * @param int $id
     * @return void
     */
    public function edit(UserRequest $request, int $id): void
    {
        self::query()
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'username' => $request->username,
                'email' => $request->email,
                'team' => $request->team,
                'active' => $request->boolean('active')
            ]);
        $user = self::getUserById($id)->first();
        $user->syncRoles($request->role);
    }

    /**
     * @param int $id
     * @return void
     */
    public function uDelete(int $id): void
    {
        self::query()
            ->where('id', $id)
            ->update([
                'active' => false,
                'deleted' => true
            ]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function defdelete(int $id): void
    {
        self::query()
            ->where('id', $id)
            ->delete();
    }

    /**
     * @param int $id
     * @return void
     */
    public function restore(int $id): void
    {
        self::query()
            ->where('id', $id)
            ->update([
                'active' => false,
                'deleted' => false
            ]);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }
}
