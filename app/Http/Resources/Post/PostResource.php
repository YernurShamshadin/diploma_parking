<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="PostResourceV1",
 *
 *     @OA\Property(
 *          property="id",
 *          type="integer",
 *          example="1"
 *     ),
 *     @OA\Property(
 *          property="title",
 *          type="string",
 *          example="Hello postermoster"
 *     ),
 *     @OA\Property(
 *          property="like",
 *          type="integer",
 *          example="1"
 *     )
 * )
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
			'id' => $this->id,
			'title' => $this->title,
			'like' => $this->like,
		];
    }
}
