<?php


namespace App\Models;

use Elo\Modelo;

class TipoSang extends Modelo
{
    protected bool $exclusaoLogica = true;

    protected array $temMuitos = [
        'doadores' => [Doadores::class, 'fk' => 'autor_id'],
    ];
}