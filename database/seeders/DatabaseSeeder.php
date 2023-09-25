<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Invoices\Infrastructure\Database\Seeders\ProductSeeder;
use App\Modules\Invoices\Infrastructure\Database\Seeders\CompanySeeder;
use App\Modules\Invoices\Infrastructure\Database\Seeders\InvoiceSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            ProductSeeder::class,
            InvoiceSeeder::class,
        ]);
    }
}
