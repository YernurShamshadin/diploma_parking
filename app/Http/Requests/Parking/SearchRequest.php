<?php

namespace App\Http\Requests\Parking;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="ParkingSearchRequestV1",
 *      required={"keyword"},
 *
 *      @OA\Property(
 *           property="keyword",
 *           type="string",
 *           example="Parking in Satpayeva 90"
 *      ),
 *      @OA\Property(
 *           property="for_electric_car",
 *           type="boolean",
 *           example="true"
 *      ),
 *      @OA\Property(
 *           property="for_disabled_people",
 *           type="boolean",
 *           example="true"
 *      ),
 *      @OA\Property(
 *          property="door_type_id",
 *          type="integer",
 *          example="1"
 *      )
 * )
 */
class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'keyword' => ['required', 'string', 'max:255'],
            'for_electric_car' => ['nullable', 'boolean'],
            'for_disabled_people' => ['nullable', 'boolean'],
            'door_type_id' => ['nullable', 'exists:door_types,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
