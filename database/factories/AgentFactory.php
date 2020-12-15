<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"          =>  $this->faker->name(20),
            "active"        =>  $this->faker->boolean(90),
            "branch_id"    =>  Branch::all()->random()->id
        ];
    }
}
