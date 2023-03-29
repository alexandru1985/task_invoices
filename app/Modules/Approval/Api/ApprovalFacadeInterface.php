<?php

declare(strict_types=1);

namespace App\Modules\Approval\Api;

use App\Modules\Approval\Api\Dto\ApprovalDto;

interface ApprovalFacadeInterface
{
    /**
     * @param ApprovalDto $entity
     * @return true
     */
    public function approve(ApprovalDto $entity): true;

    /**
     * @param ApprovalDto $entity
     * @return true
     */
    public function reject(ApprovalDto $entity): true;
}
