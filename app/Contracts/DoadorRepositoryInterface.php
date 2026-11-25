<?php


declare(strict_types=1);

namespace App\Contracts;

use App\Models\Doador;

interface DoadorRepositoryInterface
{
    /** @return list<Doador> */
    public function listar(int $pagina, int $porPagina): array;

    public function buscar(int $id): ?Doador;

    public function criar(string $nome, string $email, int $cep, string $endereco, string $tipo_sanguineo, int $telefone): Doador;

    public function atualizar(int $id,string $nome, string $email, int $cep, string $endereco, string $tipo_sanguineo, int $telefone ): void;

    public function apagar(int $id): bool;
}