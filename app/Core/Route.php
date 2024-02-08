<?php

/**
 * @author [Hala NEMRI]
 * @email [nemri.helaa@gmail.com]
 * @desc [PHP DEVELOPER]
 */

namespace App\Core;

class Route
{
    private $routes = [];

    /**
     * Adds a route to the routing table.
     *
     * @param string $method The HTTP method (GET, POST, PUT, DELETE, etc.).
     * @param string $url The URL pattern.
     * @param string $controller The controller class name.
     * @param string $action The controller action method.
     */
    public function addRoute($method, $url, $controller, $action)
    {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'controller' => $controller,
            'action' => $action,
        ];
    }

    /**
     * Dispatches the request to the appropriate controller and action based on the requested URL and method.
     */
    public function dispatch()
    {
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {

            // Add a check for URLs with parameters
            if ($route['method'] === $method && $this->matchUrlWithParams($route['url'], $url)) {

                $controllerClass = "App\\Api\\Controllers\\{$route['controller']}";
                $actionMethod = $route['action'];

                // Extract parameters from the URL
                $params = $this->extractParams($route['url'], $url);
                // Extract query parameters
                $queryParams = $this->extractQueryParams($url);
                $params[] = $queryParams;
                // Check the request type and extract data accordingly
                if ($method === 'POST') {
                    // POST request, get form data
                    $postData = $_POST;
                    // Pass form data to the action method
                    $params[] = $postData;
                } elseif ($method === 'PUT') {
                    // PUT request, get form data from raw input
                    parse_str(file_get_contents("php://input"), $putData);
                    // Pass form data to the action method
                    $params[] = $putData;
                }

                $controller = new $controllerClass();
                // Pass parameters to the action method
                $controller->$actionMethod(...$params);

                return;
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }

    private function matchUrlWithParams($pattern, $url)
    {
        // Update to handle URLs with parameters
        $pattern = str_replace('/', '\/', $pattern);
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^\/]+)', $pattern);
        $pattern = "/^{$pattern}(\/\d+)?$/";

        return (bool) preg_match($pattern, $url);
    }

    /**
     * A function to extract parameters from the URL.
     *
     * @param string $pattern The pattern to match in the URL
     * @param string $url The URL from which to extract parameters
     * @return array The extracted parameters from the URL
     */
    private function extractParams($pattern, $url)
    {
        // Update to extract parameters from the URL
        preg_match_all('/\/(\d+)/', $url, $matches);

        if (!empty($matches[1])) {
            return [(int)$matches[1][0]];
        }

        return [];
    }
    /**
     * Extracts query parameters from the given URL.
     *
     * @param string $url The URL from which to extract query parameters
     * @return array The extracted query parameters
     */
    private function extractQueryParams($url)
    {
        $queryParams = [];
        $urlParts = parse_url($url);
        if (isset($urlParts['query'])) {
            parse_str($urlParts['query'], $queryParams);
        }

        return $queryParams;
    }
}
