<?php
//return [
////    'connections' => [
////        'default' => [
////            'hosts' => explode(' ', env('LDAP_HOSTS', 'ipa.demo1.freeipa.org')),
////            'username' => env('LDAP_USERNAME', 'uid=admin,cn=users,cn=accounts,dc=demo1,dc=freeipa,dc=org'),
////            'password' => env('LDAP_PASSWORD', 'your_ldap_admin_password'),
////            'port' => env('LDAP_PORT', 389),
////            'base_dn' => env('LDAP_BASE_DN', 'dc=demo1,dc=freeipa,dc=org'),
////            'timeout' => env('LDAP_TIMEOUT', 5),
////            'use_ssl' => env('LDAP_USE_SSL', false),
////            'use_tls' => env('LDAP_USE_TLS', false),
////        ],
////    ],
//    'connections' => [
//        'default' => [
//            'hosts' => ['ipa.demo1.freeipa.org'],
//            'base_dn' => env('LDAP_BASE_DN', 'dc=demo1,dc=freeipa,dc=org'),
//            'username' => env('LDAP_USERNAME', 'uid=admin,cn=users,cn=accounts,dc=example,dc=com'),
//            'password' => env('LDAP_PASSWORD', 'Secret123'),
//            'port' => 389,
//            'use_ssl' => false,
//            'use_tls' => false,
//        ],
//    ],
//];
//return [
//    'connection' => env('LDAP_CONNECTION', 'default'),
//    'provider' => [
//        'model' => LdapRecord\Models\ActiveDirectory\User::class,
//        'rules' => [],
//    ],
//    'usernames' => [
//        'ldap' => [
//            'discover' => 'mail',
//            'authenticate' => 'mail',
//        ],
//        'eloquent' => 'email',
//    ],
//    'sync_attributes' => [
//        'email' => 'mail',
//        'name' => 'cn',
//    ],
//    'logging' => [
//        'enabled' => env('LDAP_LOGGING', true),
//    ],
//];

return [
    'connections' => [
        'default' => [
            'hosts' => ['ipa.demo1.freeipa.org'],
            'base_dn' => 'dc=demo1,dc=freeipa,dc=org',
            'username' => env('LDAP_USERNAME', 'uid=admin,cn=users,cn=accounts,dc=demo1,dc=freeipa,dc=org'),
            'password' => env('LDAP_PASSWORD', 'Secret123'),
            'port' => 389,
            'use_ssl' => false,
            'use_tls' => false,
        ],
    ],
];
