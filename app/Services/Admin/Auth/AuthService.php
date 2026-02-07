<?php

namespace App\Services\Admin\Auth;

use Illuminate\Support\Facades\Hash;
use App\Repositories\Auth\AuthRepository;

class AuthService
{
    public function __construct(
        protected AuthRepository $repo
    ) {}

    public function login(array $data)
    {
        $user = $this->repo->findByPhone($data['phone_number']);

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return null;
        }

        return $user;
    }
}
