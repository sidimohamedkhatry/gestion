<?php

return [
    'role_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'clients' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'sidi' => 'c,r,u,d',
            'invoices' => 'c,r,u,d',
            'coma' => 'c,r,u,d',
            'employe' => 'c,r,u,d',
        
        ],

        'admin' => []
        
    ],
        'permission_map' => [
            'c' => 'create',
            'r' => 'read',
            'u' => 'update',
            'd' => 'delete',
        ],
    
];