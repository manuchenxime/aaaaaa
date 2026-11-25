<?php

declare(strict_types=1);

use App\Controllers\DoadorController;

/** @var Haki\Haki $app */

$app->get('/', [DoadorController::class, 'index']);
$app->get('/doadores', [DoadorController::class, 'index']);
$app->post('/doadores', [DoadorController::class, 'store']);
$app->get('/doadores/{id}', [DoadorController::class, 'show']);
$app->put('/doadores/{id}', [DoadorController::class, 'update']);
$app->patch('/doadores/{id}', [DoadorController::class, 'patch']);
$app->delete('/doadores/{id}', [DoadorController::class, 'destroy']);