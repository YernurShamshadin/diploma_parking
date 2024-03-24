<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $floor_number
 * @property int $capacity
 * @property int $parking_id
 * @property Carbon|string|null $created_at
 * @property Carbon|string|null $updated_at
 * @property-read Parking $parking
 */
class ParkingFloor extends Model
{
    use HasFactory;

    protected $fillable = [
        'floor_number',
        'capacity',
        'parking_id',
    ];

    protected $casts = [
        'floor_number' => 'integer',
        'capacity' => 'integer',
        'parking_id' => 'integer',
    ];

    public function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }
}
