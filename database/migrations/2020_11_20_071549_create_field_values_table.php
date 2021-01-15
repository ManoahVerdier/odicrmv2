<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Field;

class CreateFieldValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'field_values', 
            function (Blueprint $table) {
                $table->id();
                $table->text('field_id');
                $table->text('value');
                $table->text('label');
                $table->text('order')->nullable();
                $table->timestamps();
            }
        );

        $id = Field::where('name', 'type')->first()->id;
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'Entreprise',
                'label'=>'Entreprise'
            )
        );
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'Contact',
                'label'=>'Contact'
            )
        );
        $id = Field::where('name', 'odice_division')->first()->id;
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => '04',
                'label'=>'04'
            )
        );
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => '05',
                'label'=>'05'
            )
        );
        $id = Field::where('name', 'job_division')->first()->id;
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'Restoration collective',
                'label'=>'Restoration collective'
            )
        );
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'Restoration commerciale',
                'label'=>'Restoration commerciale'
            )
        );
        $id = Field::where('name', 'activity_label')->first()->id;
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => '10_Santé',
                'label'=>'10_Santé'
            )
        );
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => '20_Enseignement',
                'label'=>'20_Enseignement'
            )
        );
        $id = Field::where('name', 'gc_type')->first()->id;
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'GC',
                'label'=>'GC'
            )
        );
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'GC Groupe Odice',
                'label'=>'GC Groupe Odice'
            )
        );
        $id = Field::where('name', 'gc_label')->first()->id;
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'ACCOR',
                'label'=>'ACCOR'
            )
        );
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'AFP',
                'label'=>'AFP'
            )
        );
        $id = Field::where('name', 'end_client')->first()->id;
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'SRC',
                'label'=>'SRC'
            )
        );
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'INTERMEDIAIRE',
                'label'=>'INTERMEDIAIRE'
            )
        );
        $id = Field::where('name', 'rival')->first()->id;
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'APPA',
                'label'=>'APPA'
            )
        );
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'BOS',
                'label'=>'BOS'
            )
        );
        $id = Field::where('name', 'client_relatioship')->first()->id;
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'PROSPECT',
                'label'=>'PROSPECT'
            )
        );
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'VIP',
                'label'=>'VIP'
            )
        );
        $id = Field::where('name', 'priority')->first()->id;
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'PROSPECT',
                'label'=>'PROSPECT'
            )
        );
        DB::table('field_values')->insert(
            array(
                'field_id' => $id,
                'value' => 'PRIORITAIRE',
                'label'=>'PRIORITAIRE'
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
        Schema::dropIfExists('field_values');
    }
}
