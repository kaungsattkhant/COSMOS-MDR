<?php

namespace App\Repositories\Auth;

use App\Models\User;

class AuthRepository
{
    public function findByPhone(string $phone)
    {
        return User::where('phone_number', $phone)->first();
    }
}
