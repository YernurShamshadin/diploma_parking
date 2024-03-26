<?php

namespace App\Http\Resources\Setting;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ProfileResourceV1",
 *
 *     @OA\Property(
 *          property="avatar",
 *          type="string",
 *          example="https://example.com/avatar.png"
 *     ),
 *     @OA\Property(
 *          property="name",
 *          type="string",
 *	      	example="Kanye"
 * 	   ),
 *     @OA\Property(
 *          property="surname",
 *          type="string",
 *          example="West"
 *     ),
 *     @OA\Property(
 *          property="phone_number",
 *          type="string",
 *          example="+380123456789"
 *     )
 * )
 *
 * @mixin User
 */
class ProfileResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'avatar' => $this->avatar,
			'name' => $this->name,
			'surname' => $this->surname,
			'phone_number' => $this->phone,
		];
	}
}