<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Carbon|string $open_time
 * @property Carbon|string $close_time
 * @property int $parking_id
 * @property Carbon|string|null $created_at
 * @property Carbon|string|null $updated_at
 * @property Parking $parking
 */
class ParkingSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'open_time',
        'close_time',
        'parking_id'
    ];

    protected $casts = [
        'open_time' => 'datetime',
        'close_time' => 'datetime',
        'parking_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }
}
