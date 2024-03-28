<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\FilterRequest;
use App\Http\Resources\Parking\AddressResource;
use App\Http\Traits\ResponseTrait;
use App\Models\Address;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    use ResponseTrait;

    /**
     * @OA\Get(
     *     path="/api/parkings/addresses",
     *     operationId="GetAddressIndex",
     *     tags={"Parking"},
	 *     @OA\Parameter(
	 *       	description="For electric car",
	 *       	in="query",
	 *       	name="for_electric_car",
	 *       	required=false,
	 *       	example="true"
	 *   	),
	 *   	@OA\Parameter(
	 *       	description="For disabled people",
	 *       	in="query",
	 *       	name="for_disabled_people",
	 *       	required=false,
	 *      	example="true"
	 *   	),
	 *   	@OA\Parameter(
	 *        description="Door type",
	 *        in="query",
	 *        name="door_type_id",
	 *        required=false,
	 *        example="1"
	 *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Addresses successfully returned",
     *         @OA\JsonContent(
     *               type="array",
     *
     *               @OA\Items(ref="#/components/schemas/AddressResourceV1")
     *        )
     *     ),
     * )
     */
    public function index(FilterRequest $request): JsonResponse
    {
		$data = $request->validated();

		$addresses = Address::query()
			->when(isset($data['door_type_id']), function ($query) use ($data) {
				$query->where('door_type_id', $data['door_type_id']);
			})
			->when(isset($data['for_electric_car']), function ($query) use ($data) {
				$query->whereHas('parking', function ($query) use ($data) {
					$query->where('available_electric_charger', true);
				});
			})
			->when(isset($data['for_disabled_people']), function ($query) use ($data) {
				$query->whereHas('parking', function ($query) use ($data) {
					$query->where('available_disabled_people', true);
				});
			})
			->get();

        return $this->response(
            'Addresses successfully returned',
            AddressResource::collection($addresses)
        );
    }

    /**
     * @OA\Get(
     *     path="/api/parkings/favorites",
     *     operationId="GetAddressFavorites",
     *     tags={"Parking"},
     *     @OA\Response(
     *         response="200",
     *         description="Addresses successfully returned",
     *         @OA\JsonContent(
     *               type="array",
     *
     *               @OA\Items(ref="#/components/schemas/AddressResourceV1")
     *        )
     *     ),
     * )
     */
    public function favorites(): JsonResponse
    {
        $favoriteAddressesId = auth()->user()->favoriteParkings->load('parking.address_id');

        $favoriteAddresses = Address::query()->where('id', $favoriteAddressesId)->get();

        return $this->response(
            'Favorite parkings addresses successfully returned',
            AddressResource::collection($favoriteAddresses)
        );
    }
}
