<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $cost
 * @property int $type_id
 * @property int $parking_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Parking $parking
 * @property-read PriceType $type
 */
class ParkingPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost',
        'type_id',
        'parking_id'
    ];

    protected $casts = [
        'cost' => 'integer',
        'type_id' => 'integer',
        'parking_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(PriceType::class);
    }
}
