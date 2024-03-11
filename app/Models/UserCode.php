<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code
 * @property integer $user_id
 */
class UserCode extends Model
{
    protected $guarded = false;

    protected $fillable = [
        'code',
        'user_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];
}
