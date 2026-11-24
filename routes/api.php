<?php

declare(strict_types=1);

use App\Controllers\HomeController;

/** @var Haki\Haki $app */

$app->get('/', [HomeController::class, 'index']);
$app->get('/produtos', [ProdutoController::class, 'index']);         // listar
$app->post('/produtos', [ProdutoController::class, 'store']);        // criar
$app->get('/produtos/{id}', [ProdutoController::class, 'show']);     // ver um
$app->put('/produtos/{id}', [ProdutoController::class, 'update']);   // substituir
$app->patch('/produtos/{id}', [ProdutoController::class, 'patch']);  // alterar parte
$app->delete('/produtos/{id}', [ProdutoController::class, 'destroy']);