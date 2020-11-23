<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'clients_contracts', 
            function (Blueprint $table) {
                $table->id();
                $table->integer('client_id');
                $table->text("job")->nullable();
                $table->text("contract_type")->nullable();
                $table->text("amount")->nullable();
                $table->text("manager")->nullable();
                $table->text("commercial_action")->nullable();
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
        Schema::dropIfExists('clients_contracts');
    }
}
