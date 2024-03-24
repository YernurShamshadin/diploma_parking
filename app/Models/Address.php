<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property float $x_coordinate
 * @property float $y_coordinate
 * @property int $floor_number
 * @property int $door_type_id
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'x_coordinate',
        'y_coordinate',
        'floor_number',
        'door_type_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'x_coordinate' => 'float',
        'y_coordinate' => 'float',
        'floor_number' => 'integer',
        'door_type_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
