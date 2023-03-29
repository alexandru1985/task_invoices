<?php 

declare(strict_types=1);

namespace App\Domain\Enums;

enum ActionInvoiceEnum: string
{
    case APPROVE = 'approve';
    case REJECT = 'reject';
}
