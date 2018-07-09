<?php
namespace App\Services\User;

use Illuminate\Support\Facades\Facade;

class UserServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserService::class;
    }
}
