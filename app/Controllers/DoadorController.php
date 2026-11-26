<?php


declare(strict_types=1);

namespace App\Controllers;

use Haki\Http\Request;

final class DoadorController
{
    public function index(Request $request): array
    {
        $pagina = (int)$request->query('pagina', 1);

        return ['pagina' => $pagina, 'doadores' => []];
    }

    public function show(int $id): array
    {
        return ['doador' => ['id' => $id]];
    }
<<<<<<< HEAD

    public function store(CriarDoadorRequest $request, Response $response): Response
    {
        $doador = $this->criarProduto->executar($request->validated());

        return $response->json(['doador' => $doador], 201);
    }
=======
>>>>>>> 44d3d9349e7f1f3f89278e94342fd8ab30a6a8c2
}