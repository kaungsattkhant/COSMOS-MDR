<?php

namespace App\Repositories\Auth;

interface AuthInterface
{
    public function findByPhone(string $phone);
}
