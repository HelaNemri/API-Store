<?php

/**
 * @author [Hala NEMRI]
 * @email [nemri.helaa@gmail.com]
 * @desc [PHP DEVELOPER]
 */

namespace App\Api\Controllers;

use Firebase\JWT\JWT;
use App\Services\HelperService;


class AuthController
{
    /**
     * Generates a token for authentication purposes.
     */
    public function generateToken()
    {
        $payload = [
            'iss' => 'http://127.0.0.1',

            'exp' => time() + 3600, // 1 heure d'expiration (ajustez selon vos besoins)
        ];

        $token = JWT::encode($payload, HelperService::$key, 'HS256');
        HelperService::respondJson($token, !!$token);
    }
}
