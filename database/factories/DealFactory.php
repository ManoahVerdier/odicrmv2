<?php

namespace Database\Factories;

use App\Models\Deal;
use App\Models\Client;
use App\Models\Branch;
use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Deal::class;
    protected $types = ['AO', 'GO', 'GG', 'GA', 'CE'];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title"             =>  $this->faker->text(20),
            "amount"            =>  rand(0, 10000000),
            "probability"       =>  rand(0, 10)*10,
            "project_lead"      =>  $this->faker->text(10),
            "prime_contractor"  =>  $this->faker->text(10),
            "bearer"            =>  $this->faker->text(10),
            "type"              =>  $this->types[array_rand($this->types)],
            "estim_date"        =>  $this->faker->date(),
            "quote_date"        =>  $this->faker->date(),
            "invoice_date"      =>  $this->faker->date(),
            "reason_refused"    =>  $this->faker->text(10),
            "gif_field"         =>  $this->faker->text(10),
            "link"              =>  $this->faker->text(10),
            "job_division"      =>  $this->faker->text(10),
            "more"              =>  $this->faker->text(80),
            "branch_id"         =>  Branch::all()->random()->id,
            "agent_id"          =>  Agent::all()->random()->id,
            "step_id"           =>  rand(1, 7),
            "target"            =>  'client',
            "target_id"         =>  Client::all()->random()->id,
            "target_class"      =>  'App\Models\Client',
        ];
    }
}
