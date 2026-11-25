<?php


use Elo\Coluna;
use Elo\Migracao;
use Elo\Tabela;

return new class extends Migracao {
    public function subir(): void
    {
        Tabela::criar('tipo_sanguineo', [
            'nome' => Coluna::texto(120),
            'preco' => Coluna::decimal(10, 2)->padrao(0),
            'status' => Coluna::opcoes(['ATIVO', 'INATIVO'])->padrao('ATIVO'),
        ], ['exclusao_logica' => true]);
    }

    public function descer(): void
    {
        Tabela::apagar('tipo_sanguineo');
    }
};