<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\DoadorRepositoryInterface;
use App\Database\Connection;
use App\Models\Doador;
use PDO;

final class PdoDoadorRepository implements DoadorRepositoryInterface
{
    private readonly PDO $pdo;

    public function __construct(Connection $connection)
    {
        $this->pdo = $connection->pdo();
    }

    public function listar(int $pagina, int $porPagina): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM doadores ORDER BY id LIMIT :limite OFFSET :inicio'
        );

        $stmt->bindValue(':limite', $porPagina, PDO::PARAM_INT);
        $stmt->bindValue(':inicio', ($pagina - 1) * $porPagina, PDO::PARAM_INT);
        $stmt->execute();

        $doadores = [];

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $linha) {
            $doadores[] = new Doador(
                (int) $linha['id'],
                $linha['nome'],
                $linha['data_nascimento'],
                $linha['tipo_sanguineo'],
                $linha['telefone'],
                $linha['email'],
                $linha['cidade'],
                $linha['status']
            );
        }

        return $doadores;
    }

    public function buscar(int $id): ?Doador
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM doadores WHERE id = ?'
        );

        $stmt->execute([$id]);
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$linha) {
            return null;
        }

        return new Doador(
            (int) $linha['id'],
            $linha['nome'],
            $linha['data_nascimento'],
            $linha['tipo_sanguineo'],
            $linha['telefone'],
            $linha['email'],
            $linha['cidade'],
            $linha['status']
        );
    }

    public function criar(
        string $nome,
        string $dataNascimento,
        string $tipoSanguineo,
        string $telefone,
        ?string $email,
        string $cidade
    ): Doador {
        $stmt = $this->pdo->prepare(
            'INSERT INTO doadores 
            (nome, data_nascimento, tipo_sanguineo, telefone, email, cidade)
            VALUES (?, ?, ?, ?, ?, ?)'
        );

        $stmt->execute([
            $nome,
            $dataNascimento,
            $tipoSanguineo,
            $telefone,
            $email,
            $cidade
        ]);

        return new Doador(
            (int) $this->pdo->lastInsertId(),
            $nome,
            $dataNascimento,
            $tipoSanguineo,
            $telefone,
            $email,
            $cidade,
            'ATIVO'
        );
    }

    public function atualizar(
        int $id,
        string $nome,
        string $dataNascimento,
        string $tipoSanguineo,
        string $telefone,
        ?string $email,
        string $cidade
    ): void {
        $stmt = $this->pdo->prepare(
            'UPDATE doadores SET nome = ?, data_nascimento = ?, 
            tipo_sanguineo = ?, telefone = ?, email = ?, cidade = ?
            WHERE id = ?'
        );

        $stmt->execute([
            $nome,
            $dataNascimento,
            $tipoSanguineo,
            $telefone,
            $email,
            $cidade,
            $id
        ]);
    }

    public function apagar(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            'DELETE FROM doadores WHERE id = ?'
        );

        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }
}
