<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $path
 * @property int $parking_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Parking $parking
 */
class ParkingPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'parking_id',
    ];

    protected $casts = [
        'parking_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }
}
