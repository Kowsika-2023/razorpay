<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;




/**
 * @OA\Info(
 *    title="Queue Api",
 *    version="1.0.0",
 * )
 *    @OA\SecurityScheme(
 *     type="http",
     *    securityScheme="bearerAuth",
     *    in="header",
     *    name="bearerAuth",
     
     *    scheme="bearer",
     *    bearerFormat="JWT",
     * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
