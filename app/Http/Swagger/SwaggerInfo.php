<?php

namespace App\Http\Swagger;

/**
 * @OA\Info(
 *     title="API Cafetería",
 *     version="1.0.0",
 *     description="API para gestión de cafetería"
 * )
 *
 * @OA\Server(
 *     url="http://127.0.0.1:8000",
 *     description="Servidor Local"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer"
 * )
 */
class SwaggerInfo
{
    // Clase vacía solo para anotaciones
}
