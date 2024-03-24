<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $calling_phone
 * @property int $capacity
 * @property int $floor_number
 * @property bool $available_disabled_people
 * @property bool $available_electric_charger
 * @property int $status_id
 * @property int $address_id
 * @property bool $has_additional_services
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Address $address
 * @property-read ParkingStatus $status
 */
class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'calling_phone',
        'capacity',
        'floor_number',
        'available_disabled_people',
        'available_electric_charger',
        'status_id',
        'address_id',
        'has_additional_services',
    ];

    protected $casts = [
        'capacity' => 'integer',
        'floor_number' => 'integer',
        'status_id' => 'integer',
        'address_id' => 'integer',
        'available_disabled_people' => 'boolean',
        'available_electric_charger' => 'boolean',
        'has_additional_services' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ParkingStatus::class);
    }
}
