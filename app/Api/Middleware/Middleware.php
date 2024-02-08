<?php

namespace App\Api\Middleware;

use App\Services\HelperService;

class Middleware
{
    /**
     * Authenticates the user based on the 'Authorization' header in the request.
     */
    public static function authenticate()
    {
        $headers = getallheaders();
        // Check if the 'Authorization' header exists
        if (isset($headers['Authorization'])) {
            // Extract the token from the 'Authorization' header
            $authorizationHeader = $headers['Authorization'];

            // Check if the header starts with 'Bearer'
            if (strpos($authorizationHeader, 'Bearer ') === 0) {
                // Extract the token after 'Bearer '
                $token = substr($authorizationHeader, 7);

                // Verify the token
                $userData = HelperService::verifyToken($token);

                if (!$userData) {
                    http_response_code(401);
                    echo json_encode(['error' => 'Your token is expired or invalid']);
                    exit;
                }
                return;
            }
        }

        // No valid Authorization header found
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized ! You have to generate a token first using the /auth route']);
        exit;
    }
}
