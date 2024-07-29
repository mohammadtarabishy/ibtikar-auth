<?php
return [
    'connection' => env('LDAP_CONNECTION', 'default'),
    'provider' => [
        'model' => LdapRecord\Models\ActiveDirectory\User::class,
        'rules' => [],
    ],
    'usernames' => [
        'ldap' => [
            'discover' => 'mail',
            'authenticate' => 'mail',
        ],
        'eloquent' => 'email',
    ],
    'sync_attributes' => [
        'email' => 'mail',
        'name' => 'cn',
    ],
    'logging' => [
        'enabled' => env('LDAP_LOGGING', true),
    ],
];
