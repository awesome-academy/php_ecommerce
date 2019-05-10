<?php

return [
    'product' => [
        'number_retrieve' => '6',
        'number_pagination' => '9',
        'number_recommendation' => '4',
        'number_recommendation_limit' => '0',
        'number_rating' => '5',
        'number_round_rating' => '1',
        'number_unavailable_limit' => '0',
        'image_path' => 'img/products/',
    ],
    'role' => [
        'admin' => '1',
        'guest' => '0',
    ],
    'review' => [
        'number_retrieve' => '5',
    ],
    'user' => [
        'image_path' => '/img/users/',
        'image_default' => 'default.png',
    ],
    'status' => [
        'pending' => 0,
        'accepted' => 1,
        'rejected' => -1,
    ],
    'chart' => [
        'num_year' => '10',
        'dimensions' => [
            'width' => '1000',
            'height' => '500',
        ],
    ],
];
