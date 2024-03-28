<?php

namespace App\Http\Controllers;

use App\Http\Requests\Parking\SearchRequest;
use App\Http\Resources\Parking\ParkingResource;
use App\Http\Resources\Parking\SearchResource;
use App\Http\Traits\ResponseTrait;
use App\Models\Parking;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class ParkingController extends Controller
{
    use ResponseTrait;

    /**
     * @OA\Get(
     *     path="/api/parkings/{parking}",
     *     operationId="GetParkingShow",
     *     tags={"Parking"},
     *     @OA\Parameter(
     *           description="ID of parking",
     *           in="path",
     *           name="parking",
     *           required=true,
     *           example="1"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Parking successfully returned",
     *         @OA\JsonContent(ref="#/components/schemas/ParkingResourceV1")
     *     )
     * )
     *
     * @param int $parking
     * @return JsonResponse
     */
    public function show(int $parking): JsonResponse
    {
        $parkingForResponse = Parking::query()
            ->where('id', $parking)
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
            new ParkingResource($parkingForResponse)
        );
    }

    /**
     * @OA\Get(
     *  path="/api/parkings/search",
     *  operationId="GetParkingSearch",
     *  tags={"Parking"},
     *  @OA\Parameter(
     *      description="Keyword for search",
     *      in="query",
     *      name="keyword",
     *      required=true,
     *      example="Parking in Satpayeva 90"
     *  ),
     *  @OA\Parameter(
     *      description="For electric car",
     *      in="query",
     *      name="for_electric_car",
     *      required=false,
     *      example="true"
     *  ),
     *  @OA\Parameter(
     *      description="For disabled people",
     *      in="query",
     *      name="for_disabled_people",
     *      required=false,
     *      example="true"
     *  ),
     *  @OA\Parameter(
     *      description="Door type",
     *      in="query",
     *      name="door_type_id",
     *      required=false,
     *      example="1"
     *  ),
     *  @OA\Response(
     *      response="200",
     *      description="Parkings names successfully returned",
     *      @OA\JsonContent(
     *          type="array",
     *
     *          @OA\Items(ref="#/components/schemas/ParkingSearchResourceV1")
     *      )
     *  )
     * )
     *
     * @param SearchRequest $request
     * @return JsonResponse
     */
    public function search(SearchRequest $request): JsonResponse
    {
        $data = $request->validated();

        $parkingsWithAddress = Parking::query()
            ->where('name', 'ilike', "%{$data['keyword']}%")
            ->whereHas('address', function ($query) use ($data) {
                $query
                    ->where('title', 'ilike', "%{$data['keyword']}%")
                    ->when(isset($data['door_type_id']), function ($query) use ($data) {
                        $query->where('door_type_id', $data['door_type_id']);
                    });
            })
            ->when(isset($data['for_electric_car']), function ($query) use ($data) {
                $query->where('available_electric_charger', true);
            })
            ->when(isset($data['for_disabled_people']), function ($query) use ($data) {
                $query->where('available_disabled_people', true);
            })
            ->with('address')
            ->get();

        return $this->response(
            'Parkings names successfully returned',
            SearchResource::collection($parkingsWithAddress)
        );
    }
}
