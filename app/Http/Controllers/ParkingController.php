<?php

namespace App\Http\Controllers;

use App\Http\Resources\Parking\ParkingResource;
use App\Http\Traits\ResponseTrait;
use App\Models\Parking;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class ParkingController extends Controller
{
    use ResponseTrait;

    /**
     * @OA\Get(
     *     path="/api/parking/{address}",
     *     operationId="GetParkingShow",
     *     tags={"Parking"},
     *     @OA\Parameter(
     *           description="ID of address",
     *           in="path",
     *           name="address",
     *           required=true,
     *           example="1"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Parking successfully returned",
     *         @OA\JsonContent(ref="#/components/schemas/AddressResourceV1")
     *     )
     * )
     */
    public function show($address): JsonResponse
    {
        $parking = Parking::query()
            ->where('address_id', $address)
            ->with([
                'regularPriceByHour',
                'schedule',
                'photos'
            ])
            ->withCount([
                'slots as reserved_slots_count' => function ($slot): void {
                    $slot->where('out_date', '>', Carbon::now());
                },
            ])
            ->withCasts([
                'reserved_slots_count' => 'integer',
            ])
            ->firstOrFail();

        return $this->response(
            'Parking successfully returned',
            new ParkingResource($parking)
        );
    }
}
