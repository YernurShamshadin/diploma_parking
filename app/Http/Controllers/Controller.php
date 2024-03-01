<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="Diploma parking API",
 *      version="1.0",
 *      description="",
 *
 *      @OA\Contact(
 *          email="200103049@stu.sdu.edu.kz"
 *      )
 * )
 * @OA\PathItem (
 *      path="/api/"
 * ),
 *
 * @OA\Components(
 *	 @OA\SecurityScheme(
 *		 securityScheme="bearerAuth",
 *       type="http",
 *       scheme="bearer"
 *	 )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
