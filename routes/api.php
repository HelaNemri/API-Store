<?php

namespace Routes;

use App\Core\Route;

$route = new Route();

// Add routes for CRUD operations on stores
$route->addRoute('DELETE', '/magasins/{id}', 'MagasinController', 'deleteMagasin');
$route->addRoute('GET', '/magasins/{id}', 'MagasinController', 'getMagasinById');
$route->addRoute('POST', '/magasins', 'MagasinController', 'addMagasin');
$route->addRoute('PUT', '/magasins/{id}', 'MagasinController', 'updateMagasin');
$route->addRoute('GET', '/magasins?{filtres}', 'MagasinController', 'getAllMagasins');
$route->addRoute('GET', '/auth', 'AuthController', 'generateToken');
// Execute the appropriate route
$route->dispatch();
