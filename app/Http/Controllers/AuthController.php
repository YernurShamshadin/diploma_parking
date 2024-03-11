<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'phoneVerify', 'phoneLogin']]);
    }

    /**
     * @OA\Post(
     *    path="/api/auth/register",
     *    operationId="Registration",
     *    tags={"Auth"},
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
     *                   )
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
            'phone' => ['required', 'string', 'min:10', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
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
     *    path="/api/auth/phone-verification",
     *    operationId="PhoneVerification",
     *    tags={"Auth"},
     *  @OA\RequestBody(
     *
     *        @OA\MediaType(
     *                 mediaType="application/json",
     *
     *                 @OA\Schema(
     *     					@OA\Property(property="phone", type="string", example="+77059253345")
     *                   )
     *        )
     *  ),
     * 	@OA\Response(
     *        response="200",
     *        description="Code sent successfully",
     * 		@OA\JsonContent(
     *            allOf={
     *	 			@OA\Schema(
     *	 			 	@OA\Property(property="phone_number_exists", type="boolean", example="true")
     *                )
     *        }
     *        )
     *    )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function phoneVerify()
    {
        if (User::query()->where('phone', request('phone'))->exists()) {
            $twilioService = new TwilioService();
            /** @var User $user */
            $user = User::query()->where('phone', request('phone'))->firstOrFail();

            $otp = $user->generateCode();

            $dd =  $twilioService->sendVerificationCode(request('phone'), $otp);
dd($dd);

            return response()->json([
                "message" => 'Code sent successfully',
                "data" => ["phone_number_exists" => true]
            ]);
        } else {
            return response()->json([
                "message" => "The phone number doesn't exist in our system",
                "data" => ["phone_number_exists" => false]
            ], 422);
        }
    }

    /**
     * @OA\Post(
     *    path="/api/auth/phone-login",
     *    operationId="PhoneLogin",
     *    tags={"Auth"},
     *  @OA\RequestBody(
     *
     *        @OA\MediaType(
     *                 mediaType="application/json",
     *
     *                 @OA\Schema(
     *     					@OA\Property(property="phone", type="string", example="+77059253345"),
     *      				@OA\Property(property="code", type="string", example="1234")
     *                   )
     *        )
     *  ),
     * 	@OA\Response(
     *        response="200",
     *        description="Returns data",
     * 		@OA\JsonContent(
     *            allOf={
     *	 			@OA\Schema(
     *	 			 	@OA\Property(property="access_token", type="string", example="eyaskdjnajksd;jngajflvbldsdjbf"),
     *     				@OA\Property(property="token_type", type="string", example="bearer"),
     *     				@OA\Property(property="expires_in", type="integer", example="3600")
     *                )
     *        }
     *        )
     *    )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function phoneLogin()
    {
        /** @var User $user */
        $user = User::query()->where('phone', request('phone'))->firstOrFail();

        if ($user->userCode->code == request('code')) {
            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json(['message' => 'Authentication failed'], 401);
            }
        } else {
            return response()->json(['error' => 'Wrong code'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *    path="/api/auth/login",
     *    operationId="Login",
     *    tags={"Auth"},
     *  @OA\RequestBody(
     *
     *        @OA\MediaType(
     *                 mediaType="application/json",
     *
     *                 @OA\Schema(
     *     					@OA\Property(property="email", type="string", example="user@user.kz"),
     *      				@OA\Property(property="password", type="string", example="12345678")
     *                   )
     *        )
     *  ),
     * 	@OA\Response(
     *        response="200",
     *        description="Returns data",
     * 		@OA\JsonContent(
     *            allOf={
     *	 			@OA\Schema(
     *	 			 	@OA\Property(property="access_token", type="string", example="eyaskdjnajksd;jngajflvbldsdjbf"),
     *     				@OA\Property(property="token_type", type="string", example="bearer"),
     *     				@OA\Property(property="expires_in", type="integer", example="3600")
     *                )
     *        }
     *        )
     *    )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Get(
     *    path="/api/auth/me",
     *    operationId="Me",
     *    tags={"Auth"},
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
     *    path="/api/auth/logout",
     *    operationId="Logout",
     *    tags={"Auth"},
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
     * @param string $token
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
