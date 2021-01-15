<?php

namespace Database\Factories;

use App\Models\ClientCommercial;
use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientCommercialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientCommercial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "end_client"            =>  $this->faker->text(20),
            "rival"                 =>  $this->faker->text(20),
            "discount_condition"    =>  $this->faker->text(20),
            "client_relationship"   =>  $this->faker->text(20),
            "priority"              =>  $this->faker->text(20),
            "agent_id"              =>  Agent::all()->random()->id,
            "deals_nb"              =>  rand(0, 20),
            "deals_amount"          =>  rand(0, 2000000),
            "deals_estim_amount"    =>  rand(0, 1500000),
        ];
    }
}
