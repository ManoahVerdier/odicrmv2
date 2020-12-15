<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agent;
use App\Models\Deal;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Agent::factory()
            ->times(50)
            ->create();
        $this->call(
            [
                ClientsTableSeeder::class,
            ]
        );
        Deal::factory()
            ->times(5000)
            ->create();
    }
}
