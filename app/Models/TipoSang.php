<?php


namespace App\Models;

use Elo\Modelo;

class TipoSang extends Modelo
{
<<<<<<< HEAD
    protected bool $exclusaoLogica = true;

    protected array $temMuitos = [
        'doadores' => [Doadores::class, 'fk' => 'autor_id'],
=======
    protected array $pertenceAMuitos = [
        'doadores'=> Doador::class,
>>>>>>> 44d3d9349e7f1f3f89278e94342fd8ab30a6a8c2
    ];
}