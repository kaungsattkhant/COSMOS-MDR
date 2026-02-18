<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum GrnStatusEnum : string
{
    //
    use EnumTrait;
    case RECEIVED = 'received';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
}
