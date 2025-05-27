<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Codigo implements ValidationRule
{
    protected $message;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->hasUnderscores($value))
        {
            $fail(trans('validation.no_underscore'));
        }

        if ($this->startWithDashes($value))
        {
            $fail(trans('validation.no_starting_dashes'));
        }

        if ($this->endsWithDashes($value))
        {
            $fail(trans('validation.no_ending_dashes'));
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */

    protected function hasUnderscores($value){
        return preg_match('/_/', $value);
    }

    protected function startWithDashes($value){
        return preg_match('/^-/', $value);
    }

    protected function endsWithDashes($value){
        return preg_match('/-$/', $value);
    }
}
