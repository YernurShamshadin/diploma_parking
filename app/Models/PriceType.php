<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 */
class PriceType extends Model
{
    use HasFactory;

    public const REGULAR_BY_HOUR_TYPE_ID = 1;

    protected $fillable = [
        'title'
    ];

    public $timestamps = false;
}
