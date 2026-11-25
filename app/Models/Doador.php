<?php


namespace App\Models;

use Elo\Modelo;

class Doador extends Modelo
{
    protected bool $exclusaoLogica = true;

    protected array $temMuitos = [
        'responsavel' => [TipoSang::class, 'fk' => 'usuario_id'],
    ];
}