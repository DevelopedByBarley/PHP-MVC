<?php
use App\Controllers\AdminController;
use App\Controllers\AdminRender;

// route_group -> /admin


//Renders
$r->addRoute('GET', '', [AdminRender::class, 'loginPage']);
$r->addRoute('GET', '/dashboard', [AdminRender::class, 'index']);
$r->addRoute('GET', '/table', [AdminRender::class, 'table']);
$r->addRoute('GET', '/form', [AdminRender::class, 'form']);
$r->addRoute('GET', '/settings', [AdminRender::class, 'settings']);
$r->addRoute('GET', '/mailbox', [AdminRender::class, 'mailbox']);


// Operations

$r->addRoute('POST', '/login', [AdminController::class, 'login']);
$r->addRoute('POST', '/store', [AdminController::class, 'store']);
$r->addRoute('POST', '/logout', [AdminController::class, 'logout']);