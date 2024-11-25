<?php

use App\Controllers\Auth\UserAuthController;
use App\Controllers\UserController;

// route_group -> /


// AUTH
$r->addRoute('GET', '/register', [UserAuthController::class, 'registerPage']);
$r->addRoute('GET', '/login', [UserAuthController::class, 'loginPage']);

$r->addRoute('POST', '/register', [UserAuthController::class, 'store']);
$r->addRoute('POST', '/login', [UserAuthController::class, 'login']);
$r->addRoute('POST', '/logout', [UserAuthController::class, 'logout']);
//------------------------->


$r->addRoute('GET', '/dashboard', [UserController::class, 'index']);
