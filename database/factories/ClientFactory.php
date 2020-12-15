<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; 

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'type'=>"client",
            'branch_id'=>Branch::all()->random()->id,
            'name'=>$this->faker->name,
            'address'=>$this->faker->address,
            'city'=>$this->faker->city,
            'postal_code'=>$this->faker->postcode,
            'department'=>rand(0, 100),
            'country'=>$this->faker->country,
            'phone'=>$this->faker->phoneNumber,
            'fax'=>$this->faker->phoneNumber,
            'email'=>$this->faker->safeEmail,
            'is_emailing'=>rand(0, 1),
            'email_for_emailing'=>$this->faker->safeEmail,
            'website'=>$this->faker->url,
            'skype'=>Str::random(20),
            'linkedin'=>Str::random(40),
            'siren'=>$this->faker->siren,
            'naf'=>rand(0, 10000),
            'ca'=>rand(0, 1000000),
            'capital'=>rand(0, 1000000000),
            'infos'=>$this->faker->text(100),
            'remarks'=>$this->faker->text(100),
            'prefered_contact'=>rand(0, 10000),
            'src'=>Str::random(20),
            'file_src'=>Str::random(20),
            'odice_division'=>Str::random(20),
            'job_division'=>Str::random(20),
            'activity_label'=>Str::random(20),
            'imported_job'=>Str::random(20),
            'internal_code'=>rand(0, 100000),
            'client_code'=>rand(0, 100000),
            'site_code'=>rand(0, 100000),
            'gc_type'=>Str::random(20),
            'gc_label'=>Str::random(20),
        ];
    }
}
