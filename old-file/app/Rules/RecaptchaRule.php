<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class RecaptchaRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Make a POST request to the reCAPTCHA API to verify the response
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => env('6LdxTXQoAAAAAONnFN58kxnyR-cIgcquFe28cyeo'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        // Check if the reCAPTCHA response is valid (returns true or false)
        return $response['success'];
    }

    public function message()
    {
        return 'reCAPTCHA verification failed. Please try again.';
    }
}
