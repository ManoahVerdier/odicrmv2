<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsCommercialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'clients_commercials', 
            function (Blueprint $table) {
                $table->id();
                $table->integer("client_id");
                $table->text("end_client")->nullable();
                $table->text("rival")->nullable();
                $table->text("discount_condition")->nullable();
                $table->text("client_relationship")->nullable();
                $table->text("priority")->nullable();
                $table->text("odice_agent")->nullable();
                $table->integer("agent_id")->nullable();
                /*Opportunites*/
                $table->integer('deals_nb')->nullable();
                $table->integer('deals_amount')->nullable();
                $table->integer('deals_estim_amount')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients_commercials');
    }
}
