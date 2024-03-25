<?php

namespace App\Http\Controllers;

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
    public function index(): JsonResponse
    {
        $all_addresses = Address::all();

        return $this->response(
            'Addresses successfully returned',
            AddressResource::collection($all_addresses)
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
