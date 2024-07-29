<?php
namespace App\Models;

use LdapRecord\Models\Model as LdapModel;

class LdapUser extends LdapModel
{
    protected ?string $connection = 'default';
    protected $fillable = ['uid', 'cn', 'mail'];
}
