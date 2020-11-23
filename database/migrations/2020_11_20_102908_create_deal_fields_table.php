<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDealFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'deal_fields', 
            function (Blueprint $table) {
                $table->id();
                $table->text('field_name');
                $table->boolean('is_select');
                $table->text('type')->nullable();
                $table->boolean('is_mass_edit');
                $table->boolean('is_boolean')->nullable();
                $table->text('pattern')->nullable();
            }
        );

        DB::table('deal_fields')->insert(
            array(
                'field_name' => 'type',
                'is_select' => true,
                'is_mass_edit'=>true
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
        Schema::dropIfExists('deal_fields');
    }
}
