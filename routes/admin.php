<?php

use App\Controllers\AdminController;
use App\Controllers\Auth\AdminAuthController;

// route_group -> /admin

// AUTH
$r->addRoute('POST', '/login', [AdminAuthController::class, 'login']);
$r->addRoute('POST', '/logout', [AdminAuthController::class, 'logout']);
$r->addRoute('POST', '/store', [AdminAuthController::class, 'store']);



//Renders
$r->addRoute('GET', '', [AdminController::class, 'loginPage']);
$r->addRoute('GET', '/dashboard', [AdminController::class, 'index']);
$r->addRoute('GET', '/table', [AdminController::class, 'table']);
$r->addRoute('GET', '/form', [AdminController::class, 'form']);
$r->addRoute('GET', '/settings', [AdminController::class, 'settings']);
$r->addRoute('GET', '/mailbox', [AdminController::class, 'mailbox']);


// Operations

$r->addRoute('POST', '/update', [AdminController::class, 'update']);
$r->addRoute('POST', '/delete/{id}', [AdminController::class, 'delete']);