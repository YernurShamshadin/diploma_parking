<?php

namespace App\Http\Resources;

use App\Models\ParkingPhoto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="PhotoResourceV1",
 *
 *     @OA\Property(
 *          property="id",
 *          type="integer",
 *          example="1"
 *     ),
 *     @OA\Property(
 *           property="path",
 *           type="string",
 *           example="/uploads/photos/1.jpg"
 *     )
 * )
 *
 * @mixin ParkingPhoto
 */
class PhotoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'path' => $this->path,
        ];
    }
}
