<?php
namespace App\Services\impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{

    private array $users = [
        "maulana" => "secret"
    ];
   function login(string $user, string $password): bool
   {
       if(!isset($this->users[$user]))
       {
           return false;
       }

       $correctPassword = $this->users[$user];
       return $correctPassword === $password;
   }
}