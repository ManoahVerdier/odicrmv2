<?php

namespace Database\Factories;

use App\Models\ClientContract;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientContract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "job"               =>  $this->faker->text(20),
            "contract_type"              =>  $this->faker->text(20),
            "amount"            =>  rand(1, 500000),
            "manager"           =>  $this->faker->text(20),
            "commercial_action" =>  $this->faker->text(20)
        ];
    }
}
