<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $bonus_id
 * @property string $code
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property-read Bonus $bonus
 */
class BonusCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'bonus_id',
        'code',
    ];

    protected $casts = [
        'bonus_id' => 'integer',
        'code' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function bonus(): BelongsTo
    {
        return $this->belongsTo(Bonus::class);
    }
}
