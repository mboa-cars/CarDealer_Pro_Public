<?php

return [
    'standard' => [
        'label' => 'Standard',
        'car_limit' => 3,
        'price' => 0,
        'features' => [
            'Jusqu\'à 3 voitures publiées',
            'Visibilité de base',
        ],
    ],
    'premium' => [
        'label' => 'Premium',
        'car_limit' => null, // null = illimité
        'price' => 9.99,
        'features' => [
            'Publications illimitées',
            'Mise en avant',
            'Support prioritaire',
        ],
    ],
];
