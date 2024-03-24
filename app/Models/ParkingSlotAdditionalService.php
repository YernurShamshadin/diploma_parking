<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $parking_slot_id
 * @property int $additional_service_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ParkingSlotAdditionalService extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_slot_id',
        'additional_service_id',
    ];

    protected $casts = [
        'parking_slot_id' => 'integer',
        'additional_service_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
