<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 */
class ParkingStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];
}
