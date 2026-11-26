<?php

declare(strict_types=1);

use App\Controllers\DoadorController;
<<<<<<< HEAD
use App\Controllers\TipoSangController;

/** @var Haki\Haki $app */

$app->get('/doadores', [DoadorController::class, 'index']);
$app->post('/doadores', [DoadorController::class, 'store']);
$app->put('/doadores/{id}', [DoadorController::class, 'update']);
$app->patch('/doadores/{id}', [DoadorController::class, 'patch']);
$app->delete('/doadores/{id}', [DoadorController::class, 'destroy']);

$app->get('/tiposanguineo', [TipoSangController::class, 'index']);
$app->post('/tiposanguineo', [TipoSangController::class, 'store']);
$app->put('/tiposanguineo/{id}', [TipoSangController::class, 'update']);
$app->patch('/tiposanguineo/{id}', [TipoSangController::class, 'patch']);
$app->delete('/tiposanguineo/{id}', [TipoSangController::class, 'destroy']);
=======

/** @var Haki\Haki $app */

$app->get('/', [DoadorController::class, 'index']);
$app->get('/doadores', [DoadorController::class, 'index']);
$app->post('/doadores', [DoadorController::class, 'store']);
$app->get('/doadores/{id}', [DoadorController::class, 'show']);
$app->put('/doadores/{id}', [DoadorController::class, 'update']);
$app->patch('/doadores/{id}', [DoadorController::class, 'patch']);
$app->delete('/doadores/{id}', [DoadorController::class, 'destroy']);
>>>>>>> 44d3d9349e7f1f3f89278e94342fd8ab30a6a8c2
