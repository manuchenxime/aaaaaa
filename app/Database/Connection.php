<?php


declare(strict_types=1);

namespace App\Database;

use Haki\Support\Env;
use PDO;
use RuntimeException;

final class Connection
{
    private ?PDO $pdo = null;

    public function __construct(
        private readonly string                         $driver,
        private readonly string                         $database,
        private readonly string                         $host = '127.0.0.1',
        private readonly int                            $port = 3306,
        private readonly ?string                        $username = null,
        #[\SensitiveParameter] private readonly ?string $password = null,
    )
    {
    }

    public static function fromEnv(string $basePath): self
    {
        $driver = (string)Env::get('DB_CONNECTION', 'sqlite');
        $database = (string)Env::get('DB_DATABASE', 'database/app.sqlite');

        // No SQLite, um caminho relativo é a partir da raiz do projeto.
        if ($driver === 'sqlite' && !preg_match('#^([A-Za-z]:[\\\\/]|/)#', $database)) {
            $database = rtrim($basePath, '/\\') . DIRECTORY_SEPARATOR . $database;
        }

        return new self(
            $driver,
            $database,
            (string)Env::get('DB_HOST', '127.0.0.1'),
            (int)Env::get('DB_PORT', 3306),
            Env::get('DB_USERNAME'),
            Env::get('DB_PASSWORD'),
        );
    }

    public function pdo(): PDO
    {
        return $this->pdo ??= $this->connect();
    }

    private function connect(): PDO
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,       // erro de SQL vira exceção
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // linhas como array associativo
        ];

        return match ($this->driver) {
            'sqlite' => new PDO('sqlite:' . $this->database, null, null, $options),
            'mysql' => new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset=utf8mb4",
                $this->username,
                $this->password,
                $options,
            ),
            default => throw new RuntimeException("DB_CONNECTION \"{$this->driver}\" não suportado. Use sqlite ou mysql."),
        };
    }
}