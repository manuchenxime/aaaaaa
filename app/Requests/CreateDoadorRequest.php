<?php


declare(strict_types=1);

namespace App\Requests;

use Haki\Validation\FormRequest;
use Haki\Validation\Rule;

final class CreateDoadorRequest extends FormRequest
{
    public function rules(Rule $rule): array
    {
        return [
            'nome' => $rule->text()->length(3, 150),

            'data_nascimento' => $rule->date(),

            'tipo_sanguineo' => $rule->text()->oneOf(
                'A+', 'A-', 'B+', 'B-',
                'AB+', 'AB-', 'O+', 'O-'
            ),

            'telefone' => $rule->phone(),

            'email' => $rule->email()->optional(null),

            'cidade' => $rule->text()->length(2, 100),
        ];
    }
}
