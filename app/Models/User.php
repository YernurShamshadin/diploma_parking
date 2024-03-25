<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int $id
 * @property string $name
 * @property string|null     $email
 * @property Carbon|string|null $email_verified_at
 * @property string $phone
 * @property Carbon|string|null $phone_verified_at
 * @property string $password
 * @property string|null $two_factor_code
 * @property Carbon|string|null $two_factor_expires_at
 * @property-read UserCode $userCode
 * @property-read UserFavoriteParking[]|Collection $favoriteParkings
 */
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'two_factor_expires_at' => 'datetime',
    ];

	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	public function getJWTCustomClaims()
	{
		return [];
	}

    public function generateCode(): string
    {
        $code = rand(1000, 9999);

        UserCode::query()->updateOrCreate(
            ['user_id' => $this->id],
            ['code' => $code]
        );

        return (string) $code;
    }

    public function userCode(): BelongsTo
    {
        return $this->belongsTo(UserCode::class);
    }

    public function fFavoriteParkings(): HasMany
    {
        return $this->hasMany(UserFavoriteParking::class);
    }
}
