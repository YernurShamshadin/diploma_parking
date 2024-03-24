<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $bonus_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @property-read Bonus $bonus
 */
class UserBonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bonus_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'bonus_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bonus(): BelongsTo
    {
        return $this->belongsTo(Bonus::class);
    }
}
