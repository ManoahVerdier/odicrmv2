<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'branches', 
            function (Blueprint $table) {
                $table->id();
                $table->text('name');
                $table->text('code');
                $table->timestamps();
                $table->softDeletes();
            }
        );

        DB::table('branches')->insert(
            array(
                'name' => 'Provence Froid',
                "code" => 'PF'
            )
        );
        DB::table('branches')->insert(
            array(
                'name' => 'ALTECC',
                'code' => 'ALTECC'
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
        Schema::dropIfExists('branches');
    }
}
