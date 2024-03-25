<?php

namespace App\Http\Resources\Parking;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="AddressResourceV1",
 *
 *     @OA\Property(
 *            property="id",
 *            type="integer",
 *            example="1"
 *     ),
 *     @OA\Property(
 *            property="x",
 *            type="float",
 *            example="1.000001"
 *     ),
 *     @OA\Property(
 *            property="y",
 *            type="float",
 *            example="1.000001"
 *     ),
 *     @OA\Property(
 *            property="parking_id",
 *            type="integer",
 *            example="1"
 *     )
 * )
 *
 * @mixin Address
 */
class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'x' => $this->x_coordinate,
            'y' => $this->y_coordinate,
            'parking_id' => $this->parking?->id
        ];
    }
}
