<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'steps', 
            function (Blueprint $table) {
                $table->id();
                $table->text('name');
                $table->text('icon');
                $table->integer('percent');
                $table->boolean('means_active');
                $table->timestamps();
            }
        );

        DB::table('steps')->insert(
            array(
                'name' => 'Projet',
                'icon' => 'fa-lightbulb',
                'percent' => 5,
                'means_active'=>false
            )
        );
        DB::table('steps')->insert(
            array(
                'name' => 'Contacter',
                'icon' => 'fa-paper-plane',
                'percent' => 20,
                'means_active'=>false
            )
        );
        DB::table('steps')->insert(
            array(
                'name' => 'Rdv prévu',
                'icon' => 'fa-calendar-check',
                'percent' => 40,
                'means_active'=>false
            )
        );
        DB::table('steps')->insert(
            array(
                'name' => 'Envoyé',
                'icon' => 'fa-hourglass-half',
                'percent' => 60,
                'means_active'=>false
            )
        );
        DB::table('steps')->insert(
            array(
                'name' => 'Négo finale',
                'icon' => 'fa-balance-scale',
                'percent' => 80,
                'means_active'=>false
            )
        );
        DB::table('steps')->insert(
            array(
                'name' => 'Perdu',
                'icon' => 'fa-window-close',
                'percent' => 100,
                'means_active'=>false
            )
        );
        DB::table('steps')->insert(
            array(
                'name' => 'Gagné',
                'icon' => 'fa-handshake',
                'percent' => 100,
                'means_active'=>false
            )
        );
        DB::table('steps')->insert(
            array(
                'name' => 'Variante',
                'icon' => 'fa-question-circle',
                'percent' => 100,
                'means_active'=>false
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('steps');
    }
}
