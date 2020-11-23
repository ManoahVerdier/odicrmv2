<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateClientFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'client_fields', 
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

        DB::table('client_fields')->insert(
            array(
                'field_name' => 'type',
                'is_select' => true,
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'branch_code',
                'is_select' => true,
                'is_mass_edit' => true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'name',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'address',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'city',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'postal_code',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true,
                'pattern'=>'[0-9]{5}'
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'department',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true,
                'pattern'=>'[0-9]{2}'
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'country',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'phone',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true,
                'pattern'=>'0[1-9][0-9]{8}'
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'fax',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true,
                'pattern'=>'0[1-9][0-9]{8}'
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'email',
                'is_select' => false,
                'type' => 'email',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'is_emailing',
                'is_select' => true,
                'is_mass_edit'=>true,
                'is_boolean'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'email_for_emailing',
                'is_select' => false,
                'type' => 'email',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'website',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'skype',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'linkedin',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'siren',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'naf',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'ca',
                'is_select' => false,
                'type' => 'number',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'capital',
                'is_select' => false,
                'type' => 'number',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'infos',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'remarks',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'prefered_contact',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>false
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'src',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'file_src',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'odice_division',
                'is_select' => true,
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'job_division',
                'is_select' => true,
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'activity_label',
                'is_select' => true,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'imported_job',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'internal_code',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'client_code',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>false
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'site_code',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'gc_type',
                'is_select' => true,
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'gc_label',
                'is_select' => true,
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'end_client',
                'is_select' => true,
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'rival',
                'is_select' => true,
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'discount_condition',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'client_relationship',
                'is_select' => true,
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'priority',
                'is_select' => true,
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'odice_agent',
                'is_select' => true,
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'agent_id',
                'is_select' => true,
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'job',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'type',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'amount',
                'is_select' => false,
                'type' => 'number',
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'manager',
                'is_select' => true,
                'is_mass_edit'=>true
            )
        );
        DB::table('client_fields')->insert(
            array(
                'field_name' => 'commercial_action',
                'is_select' => false,
                'type' => 'text',
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
        Schema::dropIfExists('client_fields');
    }
}
