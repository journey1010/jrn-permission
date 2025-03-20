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
    
    'enabled_events' => false, 

    'cache' => [
        
        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        'prefix' => 'jrn.rbac.',
        
        'store' => 'default'
    ]
];