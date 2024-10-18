<?php

use App\Controllers\Controller;
use App\Services\LanguageService;

// route_group -> /


$r->addRoute('GET', '', [Controller::class, 'index']);
$r->addRoute('GET', 'cookie-info', [Controller::class, 'cookie']);
$r->addRoute('GET', 'lang/{value}', [LanguageService::class, 'switchLanguage']);
$r->addRoute('POST', 'test', [Controller::class, 'test']);
