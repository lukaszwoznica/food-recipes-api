<?php

namespace App\GraphQL\Validators;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;

final class UpdateIngredientInputValidator extends Validator
{
    public function rules(): array
    {
        return [
            'id' => [
                'required', 'integer'
            ],
            'name' => [
                'required', 'string', 'min:2', 'max:255',
                Rule::unique('ingredients', 'name')->ignore($this->arg('id'))
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'id' => 'id',
            'name' => 'name'
        ];
    }
}
