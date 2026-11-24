<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\DoadorRepositoryInterface;
use App\Database\Connection;
use App\Models\Doador;
use PDO;

final class DoadorRepository implements DoadorRepositoryInterface
{
    private readonly PDO $pdo;

    public function __construct(Connection $connection)
    {
        $this->pdo = $connection->pdo();
    }

    public function listar(int $pagina, int $porPagina): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM doadores ORDER BY id LIMIT :limite OFFSET :inicio');
        $stmt->bindValue(':limite', $porPagina, PDO::PARAM_INT);
        $stmt->bindValue(':inicio', ($pagina - 1) * $porPagina, PDO::PARAM_INT);
        $stmt->execute();

        $doadores = [];

        foreach ($stmt->fetchAll() as $linha) {
            $doadores[] = new Doador((int) $linha['id'], $linha['nome'], $linha['data_nascimento'], $linha['tipo_sanguineo'], $linha['telefone'], $linha['email'], $linha['cidade'], $linha['cep'], $linha['status']);
        }

        return $doadores;
    }

    public function buscar(int $id): ?Doador
    {
        $stmt = $this->pdo->prepare('SELECT * FROM doadores WHERE id = ?');
        $stmt->execute([$id]);
        $linha = $stmt->fetch();

        if (!$linha) {
            return null;
        }

        return new Doador((int) $linha['id'], $linha['nome'], $linha['data_nascimento'], $linha['tipo_sanguineo'], $linha['telefone'], $linha['email'], $linha['cidade'], $linha['cep'], $linha['status']);
    }

    public function criar(string $nome, string $dataNascimento, string $tipoSanguineo, string $telefone, ?string $email, string $cidade, string $cep): Doador
    {
        $stmt = $this->pdo->prepare('INSERT INTO doadores (nome, data_nascimento, tipo_sanguineo, telefone, email, cidade, cep) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$nome, $dataNascimento, $tipoSanguineo, $telefone, $email, $cidade, $cep]);

        return new Doador((int) $this->pdo->lastInsertId(), $nome, $dataNascimento, $tipoSanguineo, $telefone, $email, $cidade, $cep, 'ATIVO');
    }

    public function atualizar(int $id, string $nome, string $dataNascimento, string $tipoSanguineo, string $telefone, ?string $email, string $cidade, string $cep): void
    {
        $stmt = $this->pdo->prepare('UPDATE doadores SET nome = ?, data_nascimento = ?, tipo_sanguineo = ?, telefone = ?, email = ?, cidade = ?, cep = ? WHERE id = ?');
        $stmt->execute([$nome, $dataNascimento, $tipoSanguineo, $telefone, $email, $cidade, $cep, $id]);
    }

    public function apagar(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM doadores WHERE id = ?');
        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }
}
