<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum UserTypeEnum: string
{
    //
    use EnumTrait;

    case SUPERADMIN = 'super_admin';
    case ADMIN =  'admin';
    case STAFF = 'staff';
}
