<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $parking_slot_id
 * @property int $user_id
 * @property int $user_vehicle_id
 * @property Carbon|string $in_date
 * @property Carbon|string $out_date
 * @property Carbon|string|null $created_at
 * @property Carbon|string|null $updated_at
 * @property-read User $user
 * @property-read UserVehicle $userVehicle
 * @property-read ParkingSlot $parkingSlot
 */
class ParkingBookingHistory extends Model
{
    use HasFactory;

    protected $casts = [
        'parking_slot_id' => 'integer',
        'user_id' => 'integer',
        'customer_auto_number' => 'integer',
        'in_date' => 'datetime',
        'out_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'parking_slot_id',
        'user_id',
        'user_vehicle_id',
        'in_date',
        'out_date',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userVehicle(): BelongsTo
    {
        return $this->belongsTo(UserVehicle::class);
    }

    public function parkingSlot(): BelongsTo
    {
        return $this->belongsTo(ParkingSlot::class);
    }
}
