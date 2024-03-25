<?php

namespace App\Http\Resources\Parking;

use App\Models\Parking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ParkingSearchResourceV1",
 *
 *     @OA\Property(
 *          property="parking_id",
 *          description="Parking id",
 *          type="integer",
 *          example="1"
 *     ),
 *     @OA\Property(
 *          property="name_address",
 *          type="string",
 *          example="ADK Parking, Satpayeva 90"
 *     )
 * )
 *
 * @mixin Parking
 */
class SearchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'parking_id' => $this->id,
            'name_address' => $this->name.', '.$this->address->title,
        ];
    }
}
