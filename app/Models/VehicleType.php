<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 */
class VehicleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public $timestamps = false;
}
