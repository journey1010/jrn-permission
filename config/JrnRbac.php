<?php

return [
    
    'role_default' => 'role',

    'permission_default' => 'permission', 

    'tables' => [
        
        'roles' => 'roles',
        
        'permissions' => 'permissions',
        
        'role_user' => 'role_user',
        
        'permission_user' => 'permission_user',
        
        'permission_role' => 'permission_role'
    ], 

    'foreign_keys' => [
        /**
         * User foreign key on Laratrust's role_user and permission_user tables.
         */
        'user' => 'user_id',

        /**
         * Role foreign key on Laratrust's role_user and permission_role tables.
         */
        'role' => 'role_id',

        /**
         * Role foreign key on Laratrust's permission_user and permission_role tables.
         */
        'permission' => 'permission_id',
    ],
    
    'enabled_events' => false, 

    'cache' => [
        
        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        'prefix' => 'jrn.rbac.',
        
        'store' => 'default'
    ]
];