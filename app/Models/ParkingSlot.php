<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $slot_number
 * @property string|null $group_code
 * @property int $floor_id
 * @property int $parking_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property ParkingFloor $floor
 * @property Parking $parking
 */
class ParkingSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot_number',
        'group_code',
        'floor_id',
        'parking_id',
    ];

    protected $casts = [
        'slot_number' => 'integer',
        'floor_id' => 'integer',
        'parking_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function floor(): BelongsTo
    {
        return $this->belongsTo(ParkingFloor::class);
    }

    public function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }
}
