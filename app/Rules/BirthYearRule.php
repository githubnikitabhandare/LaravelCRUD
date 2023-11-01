<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BirthYearRule implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!($value >= 1980 && $value <= date('Y'))){
            $fail('The :attribute must be between 1980 to '.date('Y').'.');
        }

    }
}
