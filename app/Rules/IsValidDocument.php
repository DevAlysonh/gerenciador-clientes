<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsValidDocument implements Rule
{
    public function passes($attribute, $value)
    {
        if (strlen($value) === 11 || strlen($value) === 14) {
            return true;
        }


        return false;
    }

    public function message()
    {
        return 'O documento informado é inválido.';
    }
}
