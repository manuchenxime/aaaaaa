<?php


namespace App\Models;

use Elo\Modelo;

class TipoSang extends Modelo
{
    protected array $pertenceAMuitos = [
        'doadores'=> Doador::class,
    ];
}