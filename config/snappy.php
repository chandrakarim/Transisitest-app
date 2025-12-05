<?php

return [
    'pdf' => [
        'enabled' => true,
        'binary'  => env('WKHTMLTOPDF_BINARY', '"C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe"'),
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],

    'image' => [
        'enabled' => true,
        'binary'  => '"C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltoimage.exe"', // Gunakan tanda kutip ganda
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],
    
];
