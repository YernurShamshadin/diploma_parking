<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="AddressFilterRequestV1",
 *      required={},
 *
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
class FilterRequest extends FormRequest
{
	public function rules(): array
	{
		return [
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