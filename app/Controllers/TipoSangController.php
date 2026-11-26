<?php


declare(strict_types=1);

namespace App\Controllers;

use Haki\Http\Request;

<<<<<<< HEAD
final class TipoSangController
=======
final class ProdutoController
>>>>>>> 44d3d9349e7f1f3f89278e94342fd8ab30a6a8c2
{
    public function index(Request $request): array
    {
        $pagina = (int)$request->query('pagina', 1);

<<<<<<< HEAD
        return ['pagina' => $pagina, 'tipos_sanguineos' => []];
=======
        return ['pagina' => $pagina, 'tipossanguineos' => []];
>>>>>>> 44d3d9349e7f1f3f89278e94342fd8ab30a6a8c2
    }

    public function show(int $id): array
    {
<<<<<<< HEAD
        return ['tipo_sanguineo' => ['id' => $id]];
    }

    public function store(CriarTipoSangRequest $request, Response $response): Response
    {
        $tipo_sanguineo = $this->criarTiposang->executar($request->validated());

        return $response->json(['tipo_sanguineo' => $tipo_sanguineo], 201);
    }


=======
        return ['tiposanguineo' => ['id' => $id]];
    }
>>>>>>> 44d3d9349e7f1f3f89278e94342fd8ab30a6a8c2
}