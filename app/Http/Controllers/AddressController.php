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
     *     path="/api/parking/addresses",
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
}
