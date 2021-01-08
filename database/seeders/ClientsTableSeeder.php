<?php

namespace Database\Seeders;

use \App\Models\Client;
use \App\Models\ClientCommercial;
use \App\Models\ClientContract;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::factory()
            ->times(30)
            ->create()
            ->each(
                function ($client) {
                    $client->commercial()->save(ClientCommercial::factory()->make());
                    $client->contract()->save(ClientContract::factory()->make());
                }
            );
    }
}
