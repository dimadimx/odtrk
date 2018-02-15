<?php
return [
    'managerRadio' => [
        'type' => 2,
        'description' => 'Manager radio',
    ],
    'radio' => [
        'type' => 1,
        'children' => [
            'managerRadio',
        ],
    ],
    'managerTb' => [
        'type' => 2,
        'description' => 'Manager tb',
    ],
    'tb' => [
        'type' => 1,
        'children' => [
            'managerTb',
        ],
    ],
    'managerAdmin' => [
        'type' => 2,
        'description' => 'Manager admin',
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'managerAdmin',
            'managerTb',
            'managerRadio',
        ],
    ],
];
