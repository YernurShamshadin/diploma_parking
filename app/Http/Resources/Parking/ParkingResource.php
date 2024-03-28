<?php

namespace App\Http\Resources\Parking;

use App\Http\Resources\PhotoResource;
use App\Models\Parking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ParkingResourceV1",
 *
 *     @OA\Property(
 *          property="id",
 *          type="integer",
 *          example="1"
 *     ),
 *     @OA\Property(
 *           property="name",
 *           type="string",
 *           example="ADK Parking"
 *     ),
 *     @OA\Property(
 *           property="address_title",
 *           type="string",
 *           example="Satpayeva 90"
 *     ),
 *     @OA\Property(
 *           property="address_x",
 *           type="float",
 *           example="1.000001"
 *     ),
 *     @OA\Property(
 *           property="address_y",
 *           type="float",
 *           example="1.000001"
 *     ),
 *     @OA\Property(
 *           property="phone",
 *           type="string",
 *           example="+7 (999) 999-99-99"
 *     ),
 *     @OA\Property(
 *           property="free_slots",
 *           type="integer",
 *           example="100"
 *     ),
 *     @OA\Property(
 *           property="schedule",
 *           type="string",
 *           example="10:00 - 18:00"
 *     ),
 *     @OA\Property(
 *           property="price_regular_by_hour",
 *           type="integer",
 *           example="200"
 *     ),
 *     @OA\Property(
 *           property="disabled_people",
 *           type="boolean",
 *           example="true"
 *     ),
 *     @OA\Property(
 *           property="electric_charger",
 *           type="boolean",
 *           example="true"
 *     ),
 *     @OA\Property(
 *           property="photos",
 *           type="array",
 *
 *           @OA\Items(ref="#/components/schemas/PhotoResourceV1")
 *     )
 * )
 *
 * @mixin Parking
 * @property-read int $reserved_slots_count
 */
class ParkingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address_title' => $this->address->title,
            'address_x' => $this->address->x_coordinate,
            'address_y' => $this->address->y_coordinate,
            'phone' => $this->calling_phone,
            'free_slots' => $this->capacity - $this->reserved_slots_count,
            'schedule' => $this->schedule?->open_time.' - '.$this->schedule?->close_time,
            'price_regular_by_hour' => $this->regularPriceByHour?->cost,
            'disabled_people' => $this->available_disabled_people,
            'electric_charger' => $this->available_electric_charger,
            'photos' => PhotoResource::collection($this->photos),
        ];
    }
}
