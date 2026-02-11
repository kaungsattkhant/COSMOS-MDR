<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum PurchaseOrderStatusEnum: string
{
    use EnumTrait;
    case DRAFT = 'draft';
    case PARTIAL_RECEIVED = 'partial_received';
    case RECEIVED = 'received';
    case CLOSED = 'closed';
}