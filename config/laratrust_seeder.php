<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'operator' => [
            'users' => 'c,r,u,d',
            'userfile' => 'c,r,u,d',
            'adminfile' => 'c,r,u,d'
        ],
        'admin' => [
            //'users' => 'c,r,u,d',
            'userfile' => 'c,r,u,d',
            'adminfile' => 'c,r,u,d'
        ],
        'user' => [
            //'profile' => 'r,u',
            'userfile' => 'c,r,u,d'
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
