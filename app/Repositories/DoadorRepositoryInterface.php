<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Models\Doador;

interface DoadorRepositoryInterface
{
    /** @return list<Doador> */
    public function listar(int $pagina, int $porPagina): array;

    public function buscar(int $id): ?Doador;

    public function criar(string $nome, string $dataNascimento, string $tipoSanguineo, string $telefone, ?string $email, string $cidade, string $cep): Doador;

    public function atualizar(int $id, string $nome, string $dataNascimento, string $tipoSanguineo, string $telefone, ?string $email, string $cidade, string $cep): void;

    public function apagar(int $id): bool;
}