<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="PostUpdateRequestV1",
 *      required={"title", "like"},
 *
 *      @OA\Property(
 *           property="title",
 *           type="string",
 *           example="Hello postermoster"
 *      ),
 *      @OA\Property(
 *           property="like",
 *           type="integer",
 *           example="1"
 *      )
 * )
 */
class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'like' => ['required', 'integer'],
        ];
    }
}
