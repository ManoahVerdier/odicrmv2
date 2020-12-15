<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'clients', 
            function (Blueprint $table) {
                $table->id();
                /*Infos générales*/
                $table->text('name');
                $table->text('type');
                $table->text('branch_id');
                $table->text('address')->nullable();
                $table->text('postal_code')->nullable();
                $table->text('city')->nullable();
                $table->text('department')->nullable();
                $table->text('country')->nullable();
                $table->text('phone')->nullable();
                $table->text('fax')->nullable();
                $table->text('email')->nullable();
                $table->text('is_emailing')->nullable();
                $table->text('email_for_emailing')->nullable();
                $table->text('website')->nullable();
                $table->text('skype')->nullable();
                $table->text('linkedin')->nullable();
                $table->text('siren')->nullable();
                $table->text('naf')->nullable();
                $table->text('ca')->nullable();
                $table->text('capital')->nullable();
                $table->text('infos')->nullable();
                $table->text('remarks')->nullable();
                $table->text('prefered_contact')->nullable();
                /*Secteur*/
                $table->text('src')->nullable();
                $table->text('file_src')->nullable();
                $table->text('odice_division')->nullable();
                $table->text('job_division')->nullable();
                $table->text('activity_label')->nullable();
                $table->text('imported_job')->nullable();
                /*Codes*/
                $table->text('internal_code')->nullable();
                $table->text('client_code')->nullable();
                $table->text('site_code')->nullable();
                /*Grand comptes*/
                $table->text('gc_type')->nullable();
                $table->text('gc_label')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
