<?php


namespace App\Models;

use Elo\Modelo;

class Doadores extends Modelo
{
    protected array  $temUm = [
        'tiposang' => TipoSang::class,
    ];
}