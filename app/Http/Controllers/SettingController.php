<?php

namespace App\Http\Controllers;

use App\Http\Requests\Setting\ProfileUpdateRequest;
use App\Http\Resources\Setting\ProfileResource;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
	use ResponseTrait;

	/**
	 * @OA\Get(
	 *     path="/api/settings/profile",
	 *     operationId="GetSettingProfile",
	 *     tags={"Settings"},
	 *     @OA\Response(
	 *         response="200",
	 *         description="Phone number successfully updated",
	 *     	   @OA\JsonContent(ref="#/components/schemas/ProfileResourceV1")
	 *     )
	 * )
	 *
	 * @param ProfileUpdateRequest $request
	 * @return JsonResponse
	 */
	public function show(ProfileUpdateRequest $request): JsonResponse
	{
		$user = $request->getCurrentUser();

		return $this->response(
			'Profile successfully returned',
			new ProfileResource($user)
		);
	}

	/**
	 * @OA\Put(
	 *     path="/api/settings/profile",
	 *     operationId="PutSettingProfile",
	 *     tags={"Settings"},
	 *     @OA\Parameter(
	 *             description="Profile Avatar",
	 *             in="query",
	 *             name="avatar",
	 *             required=false,
	 *             example="https://example.com/avatar.png"
	 *     ),
	 *     @OA\Parameter(
	 *            description="Fist Name",
	 *            in="query",
	 *            name="name",
	 *            required=false,
	 *            example="Kanye"
	 *     ),
	 *     @OA\Parameter(
	 *            description="Last Name",
	 *            in="query",
	 *            name="surname",
	 *            required=false,
	 *            example="West"
	 *     ),
	 *     @OA\Parameter(
	 *           description="Phone number",
	 *           in="query",
	 *           name="phone_number",
	 *           required=false,
	 *           example="+77777777777"
	 *     ),
	 *     @OA\Response(
	 *         response="200",
	 *         description="Phone number successfully updated",
	 *         @OA\JsonContent(ref="#/components/schemas/ProfileResourceV1")
	 *     )
	 * )
	 *
	 * @param ProfileUpdateRequest $request
	 * @return JsonResponse
	 */
	public function update(ProfileUpdateRequest $request): JsonResponse
	{
		$user = $request->getCurrentUser();
		$request = $request->validated();

		$user->update([
			'avatar'  => $request['avatar'],
			'name'    => $request['name'],
			'surname' => $request['surname'],
			'phone'   => $request['phone_number'],
		]);
		$user->save();

		return $this->response(
			'Phone number successfully updated',
			new ProfileResource($user)
		);
	}
}