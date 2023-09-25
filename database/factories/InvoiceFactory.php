<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Invoices\Entities\Invoice;
use Ramsey\Uuid\Uuid;
use App\Domain\Enums\StatusEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Invoices\Entities\Invoice>
 */
class InvoiceFactory extends Factory
{   
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "id" => $this->faker->uuid,
            "number" => $this->faker->uuid,
            "date" => $this->faker->date,
            "due_date" => $this->faker->date,
            'company_id' => $this->getRandomCompanyId(),
            'status' => StatusEnum::DRAFT->value,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }

    /**
     * @return string
     */
    public function getRandomCompanyId(): string 
    {
        $companies = DB::table('companies')->get();
        
        return $companies->random()->id;
    }
}
