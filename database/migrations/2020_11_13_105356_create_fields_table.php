<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'fields', 
            function (Blueprint $table) {
                $table->id();
                $table->text('target');
                $table->text('name');
                $table->boolean('is_select');
                $table->text('type')->nullable();
                $table->boolean('is_mass_edit');
                $table->boolean('is_boolean')->default(0);
                $table->text('pattern')->nullable();
                $table->boolean('has_model')->default(false);
                $table->text('model')->nullable();
                $table->text('depends_on')->nullable();
                $table->text('required_for')->nullable();
                $table->boolean('is_required')->default(false);
            }
        );

        DB::table('fields')->insert(
            array(
                'name' => 'type',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'branch_id',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'has_model'=>true,
                'model'=>'branch',
                'required_for'=>'agent_id',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'name',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'address',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'city',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'postal_code',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'pattern'=>'[0-9]{5}',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'department',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'pattern'=>'[0-9]{2}',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'country',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'phone',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'pattern'=>'0[1-9][0-9]{8}',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'fax',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'pattern'=>'0[1-9][0-9]{8}'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'email',
                'is_select' => false,
                'type' => 'email',
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'is_emailing',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_boolean'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'email_for_emailing',
                'is_select' => false,
                'type' => 'email',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'website',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'skype',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'linkedin',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'siren',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'naf',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'ca',
                'is_select' => false,
                'type' => 'number',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'capital',
                'is_select' => false,
                'type' => 'number',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'infos',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'remarks',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'prefered_contact',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>false,
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'src',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'file_src',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'odice_division',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'job_division',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'activity_label',
                'is_select' => true,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'imported_job',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'internal_code',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'client_code',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>false,
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'site_code',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'gc_type',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'gc_label',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'end_client',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'rival',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'discount_condition',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'client_relationship',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'priority',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'agent_id',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients',
                'has_model'=>true,
                'model'=>'agent',
                'depends_on'=>'branch_id',
                'is_required'=>true
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'job',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'type',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'amount',
                'is_select' => false,
                'type' => 'number',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'manager',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'commercial_action',
                'is_select' => false,
                'type' => 'text',
                'is_mass_edit'=>true, 
                'target'=>'clients'
            )
        );
        DB::table('fields')->insert(
            array(
                'name' => 'type',
                'is_select' => true,
                'is_mass_edit'=>true, 
                'target'=>'deals'
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
        Schema::dropIfExists('fields');
    }
}
