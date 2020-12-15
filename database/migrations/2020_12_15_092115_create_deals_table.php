<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'deals', 
            function (Blueprint $table) {
                $table->id();
                $table->text('title');
                $table->unsignedDouble('amount');
                $table->text('probability');
                $table->text('project_lead')->nullable();
                $table->text('prime_contractor')->nullable();
                $table->text('bearer')->nullable();
                $table->text('type');
                $table->date('estim_date');
                $table->date('quote_date');
                $table->date('invoice_date');
                $table->text('reason_refused')->nullable();
                $table->text('gif_field')->nullable();
                $table->text('link')->nullable();
                $table->text('job_division')->nullable();
                $table->text('more')->nullable();
                $table->integer('other_id')->nullable();
                $table->integer('branch_id');
                $table->text('agent_id');
                $table->integer('step_id');
                $table->text('target');
                $table->integer('target_id');
                $table->text('target_class');
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
        Schema::dropIfExists('deals');
    }
}
