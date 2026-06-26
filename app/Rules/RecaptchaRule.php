<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class RecaptchaRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $secret = config('inquiry.recaptcha_secret_key');

        if ($secret === '' || $secret === null) {
            return;
        }

        if (! is_string($value) || $value === '') {
            $fail('Please complete the reCAPTCHA verification.');

            return;
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secret,
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        if (! $response->successful() || ! $response->json('success')) {
            $fail('reCAPTCHA verification failed. Please try again.');
        }
    }
}
