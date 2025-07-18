<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $password = $value;

        // Check minimum length
        if (strlen($password) < 10) {
            $fail(__('The password must be at least 10 characters.'));
            return;
        }

        // Check for uppercase letter
        if (!preg_match('/[A-Z]/', $password)) {
            $fail(__('The password must contain at least one uppercase letter.'));
            return;
        }

        // Check for lowercase letter
        if (!preg_match('/[a-z]/', $password)) {
            $fail(__('The password must contain at least one lowercase letter.'));
            return;
        }

        // Check for number
        if (!preg_match('/[0-9]/', $password)) {
            $fail(__('The password must contain at least one number.'));
            return;
        }

        // Check for special character
        if (!preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]/', $password)) {
            $fail(__('The password must contain at least one special character.'));
            return;
        }
    }
} 