<?php


declare(strict_types=1);

namespace App\Requests;

use Haki\Validation\FormRequest;
use Haki\Validation\Rule;

final class CriarDoadorRequest extends FormRequest
{
    public function rules(Rule $rule): array
    {
        return [
            'nome' => $rule->text()->length(3, 100),
            'email' => $rule->email(),
            'idade' => $rule->integer()->min(18)->optional(),
            'endereco' => [
                'cidade' => $rule->text(),
                'cep' => $rule->text()->pattern('/^\d{5}-?\d{3}$/'),
            ],

            'tags' => $rule->list($rule->oneOf('vip', 'novo')),
        ];
    }
}