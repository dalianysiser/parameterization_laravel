<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ConvertCheckboxToInt implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
    public function passes($attribute, $value) {
        // Convierte "on" a 1, y cualquier otro valor a 0 
        return $value === 'on' ? true : is_numeric($value); 
    } 
    public function message() { 
        return 'The :attribute must be a valid checkbox value.';
    }
}