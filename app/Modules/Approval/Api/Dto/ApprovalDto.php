<?php

declare(strict_types=1);

namespace App\Modules\Approval\Api\Dto;

use App\Domain\Enums\StatusEnum;
use Ramsey\Uuid\UuidInterface;
use Illuminate\Database\Eloquent\Model;

final readonly class ApprovalDto
{
    /**
     * @param UuidInterface $invoiceRepository
     * @param StatusEnum $status
     * @param Model $entity
     */
    public function __construct(
        public UuidInterface $id,
        public StatusEnum $status,
        public Model $entity,
    ) {
    }
}
