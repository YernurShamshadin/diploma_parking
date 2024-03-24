<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $parking_id
 * @property string $title
 * @property string $description
 * @property int $price_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Parking $parking
 * @property-read ParkingPrice $price
 */
class ParkingAdditionalService extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_id',
        'title',
        'description',
        'price_id'
    ];

    protected $casts = [
        'parking_id' => 'integer',
        'price_id' => 'integer'
    ];

    public function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }

    public function price(): BelongsTo
    {
        return $this->belongsTo(ParkingPrice::class);
    }
}
