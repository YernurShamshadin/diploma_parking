<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login']]);
	}

	/**
	 * @OA\Get(
	 * 	path="/api/auth/login",
	 * 	operationId="Login",
	 * 	tags={"Auth"},
	 *  @OA\RequestBody(
	 *
	 *        @OA\MediaType(
	 *                 mediaType="application/json",
	 *
	 *                 @OA\Schema(
	 *     					@OA\Property(property="email", type="string", example="user@user.kz"),
	 *      				@OA\Property(property="password", type="string", example="12345678")
	 * 				   )
	 *        )
	 *  ),
	 * 	@OA\Response(
	 * 		response="200",
	 * 		description="Returns data",
	 * 		@OA\JsonContent(
	 * 			allOf={
	 *	 			@OA\Schema(
	 *	 			 	@OA\Property(property="access_token", type="string", example="eyaskdjnajksd;jngajflvbldsdjbf"),
	 *     				@OA\Property(property="token_type", type="string", example="bearer"),
	 *     				@OA\Property(property="expires_in", type="integer", example="3600")
	 *	 			)
	 *  		}
	 * 		)
	 * 	)
	 * )
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login()
	{
		$credentials = request(['email', 'password']);

		if (! $token = auth()->attempt($credentials)) {
			return response()->json(['error' => 'Unauthorized'], 401);
		}

		return $this->respondWithToken($token);
	}

	/**
	 * Get the authenticated User.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me()
	{
		return response()->json(auth()->user());
	}

	/**
	 * Log the user out (Invalidate the token).
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		auth()->logout();

		return response()->json(['message' => 'Successfully logged out']);
	}

	/**
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function refresh()
	{
		return $this->respondWithToken(auth()->refresh());
	}

	/**
	 * Get the token array structure.
	 *
	 * @param  string $token
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function respondWithToken($token)
	{
		return response()->json([
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' => auth()->factory()->getTTL() * 60
		]);
	}
}
