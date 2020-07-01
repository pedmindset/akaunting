<?php

namespace App\Traits;

use App\Jobs\Auth\CreateUser;
use App\Jobs\Common\CreateCompany;


trait DatabaseCreation {

    public static function createDbTables($host, $port, $database, $username, $password, $prefix = null)
    {
        return true;
    }

    public static function createCompany($name, $email, $locale)
    {
        dispatch_now(new CreateCompany([
            'name' => $name,
            'domain' => '',
            'email' => $email,
            'currency' => 'USD',
            'locale' => 'en_GB',
            'enabled' => '1',
        ]));
    }

    public static function createUser($email, $password, $locale, $role)
    {
        dispatch_now(new CreateUser([
            'name' => '',
            'email' => $email,
            'password' => $password,
            'locale' => 'en_GB',
            'companies' => session('company_id', 1),
            'roles' => $role,
            'enabled' => '1',
        ]));
    }


}
