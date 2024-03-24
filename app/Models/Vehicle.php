<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $auto_number
 * @property int $type_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read VehicleType $type
 */
class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_number',
    ];

    protected $casts = [
        'type_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'type_id');
    }
}
