<?php

declare(strict_types=1);

namespace App\Modules\Approval\Application;

use App\Domain\Enums\StatusEnum;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Modules\Approval\Api\Events\EntityApproved;
use App\Modules\Approval\Api\Events\EntityRejected;
use Illuminate\Contracts\Events\Dispatcher;
use LogicException;

final readonly class ApprovalFacade implements ApprovalFacadeInterface
{
    /**
     * @param Dispatcher $dispatcher
     */
    public function __construct(
        private Dispatcher $dispatcher
    ) {
    }

    /**
     * @param ApprovalDto $dto
     * @return true
     */
    public function approve(ApprovalDto $dto): true
    {
        $this->validate($dto);
        $this->dispatcher->dispatch(new EntityApproved($dto));

        return true;
    }

    /**
     * @param ApprovalDto $dto
     * @return true
     */
    public function reject(ApprovalDto $dto): true
    {
        $this->validate($dto);
        $this->dispatcher->dispatch(new EntityRejected($dto));

        return true;
    }

    /**
     * @param ApprovalDto $dto
     * @return void
     */
    private function validate(ApprovalDto $dto): void
    {
        if (StatusEnum::DRAFT !== StatusEnum::tryFrom($dto->status->value)) {
            throw new LogicException('approval status is already assigned');
        }
    }
}
