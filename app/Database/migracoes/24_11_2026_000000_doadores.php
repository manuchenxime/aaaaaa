<?php


use Elo\Coluna;
use Elo\Migracao;
use Elo\Tabela;

return new class extends Migracao {
    public function subir(): void
    {
        Tabela::criar('doadores', [
            'nome' => Coluna::texto(150),
            'email' => Coluna::texto()->unico(),
            'tiposanguineo' => Coluna::texto(4),
            'status' => Coluna::opcoes(['ATIVO', 'INATIVO'])->padrao('ATIVO'),
            'setor_id' => Coluna::pertenceA('setores')->aoExcluir('SET NULL')->nulo(),
        ], ['exclusao_logica' => true]);
    }

    public function descer(): void
    {
        Tabela::apagar('usuarios');
    }
};