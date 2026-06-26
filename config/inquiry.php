<?php

return [
    'notify_email' => env('INQUIRY_NOTIFY_EMAIL', 'navjot.singh@thegirafe.in'),

    'mail_from' => env('INQUIRY_MAIL_FROM', 'sales@aticoindia.com'),

    'mail_from_name' => env('INQUIRY_MAIL_FROM_NAME', 'Atico India'),

    'allowed_mimes' => ['pdf', 'doc', 'docx', 'xls', 'xlsx'],

    'max_file_kb' => (int) env('INQUIRY_MAX_FILE_KB', 10240),

    'recaptcha_site_key' => env('RECAPTCHA_SITE_KEY', '6LdxTXQoAAAAALx5i79u3FVOWj-Rgh0XguRBmwM_'),

    'recaptcha_secret_key' => env('RECAPTCHA_SECRET_KEY', '6LdxTXQoAAAAAONnFN58kxnyR-cIgcquFe28cyeo'),
];
