<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login', 'register']]);
	}

    /**
     * @OA\Post(
     * 	path="/api/auth/register",
     * 	operationId="Registration",
     * 	tags={"Auth"},
     *  @OA\RequestBody(
     *
     *        @OA\MediaType(
     *                 mediaType="application/json",
     *
     *                 @OA\Schema(
     *     					@OA\Property(property="name", type="string", example="User"),
     *     					@OA\Property(property="phone", type="string", example="7777777777"),
     *     					@OA\Property(property="email", type="string", example="user@user.kz"),
     *      				@OA\Property(property="password", type="string", example="12345678"),
     *      				@OA\Property(property="password_confirmation", type="string", example="12345678")
     * 				   )
     *        )
     *  ),
     * 	 	@OA\Response(
     *           response="200",
     *           description="User created successfully",
     *          @OA\JsonContent()
     *       )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:10', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', 'min:6'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
        ]);
    }

	/**
	 * @OA\Post(
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
     * @OA\Get(
     * 	path="/api/auth/me",
     * 	operationId="Me",
     * 	tags={"Auth"},
     *  security={{"bearerAuth": {} }},
     * 	@OA\Response(
     *          response="200",
     *          description="You"
     *      )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
	public function me()
	{
		return response()->json(auth()->user());
	}

    /**
     * @OA\Post(
     * 	path="/api/auth/logout",
     * 	operationId="Logout",
     * 	tags={"Auth"},
     *  security={{"bearerAuth": {} }},
     * 	@OA\Response(
     *          response="200",
     *          description="Successfully logged out"
     *      )
     * )
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
