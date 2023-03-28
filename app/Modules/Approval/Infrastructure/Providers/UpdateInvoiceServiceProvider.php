<?php

declare(strict_types=1);

namespace App\Modules\Approval\Infrastructure\Providers;

use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Application\AppovalFacade;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use App\Domain\Invoices\Actions\UpdateInvoice;

class UpdateInvoiceServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(UpdateInvoice::class, function ($app){
            $facade = new ApprovalFacade();
            return new UpdateInvoice($facade);
        });
    }
}
