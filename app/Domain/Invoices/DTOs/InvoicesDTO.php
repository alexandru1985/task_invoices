<?php

namespace App\Domain\Invoices\DTOs;

use Spatie\LaravelData\Data;

class InvoicesDTO extends Data
{
    /**
     * @param string|null $id
     * @param string|null $number
     * @param string|null $date
     * @param string|null $due_date
     * @param string|null $status
     * @param string|null $company
     * @param string|null $products
     * @param int|null $totalAmountProducts
     */
    public function __construct(
        public ?string $id,
        public ?string $number,
        public ?string $date,
        public ?string $due_date,
        public ?string $status,
        public ?string $company,
        public ?string $products,
        public ?int $totalAmountProducts
    ) {
    }
}