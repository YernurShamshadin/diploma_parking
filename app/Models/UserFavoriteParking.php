<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $parking_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Parking $parking
 * @property-read User $user
 */
class UserFavoriteParking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parking_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'parking_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
