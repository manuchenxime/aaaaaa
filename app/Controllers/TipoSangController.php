<?php


declare(strict_types=1);

namespace App\Controllers;

use Haki\Http\Request;

final class TipoSangController
{
    public function index(Request $request): array
    {
        $pagina = (int)$request->query('pagina', 1);

        return ['pagina' => $pagina, 'tipos_sanguineos' => []];
    }

    public function show(int $id): array
    {
        return ['tipo_sanguineo' => ['id' => $id]];
    }

    public function store(CriarTipoSangRequest $request, Response $response): Response
    {
        $tipo_sanguineo = $this->criarTiposang->executar($request->validated());

        return $response->json(['tipo_sanguineo' => $tipo_sanguineo], 201);
    }


}