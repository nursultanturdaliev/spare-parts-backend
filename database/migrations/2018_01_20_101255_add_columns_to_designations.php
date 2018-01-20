<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToDesignations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('model_designations', function (Blueprint $table) {
            $table->string('modification');
            $table->string('code');
            $table->string('engine_type');
            $table->string('engine_model');
            $table->string('engine_volume');
            $table->string('engine_power');
            $table->string('wheel_drive');          // привод
            $table->string('transmission');         // КПП
            $table->string('number_of_doors');
            $table->string('release_date');         // Даты выпуска
            $table->string('lifting_capacity');     // Грузоподъемность
            $table->string('chassis_configuration'); // Колесная формула
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('model_designations', function (Blueprint $table) {
            $table->dropColumn('modification');
            $table->dropColumn('code');
            $table->dropColumn('engine_type');
            $table->dropColumn('engine_model');
            $table->dropColumn('engine_volume');
            $table->dropColumn('engine_power');
            $table->dropColumn('wheel_drive');          // привод
            $table->dropColumn('transmission');         // КПП
            $table->dropColumn('number_of_doors');
            $table->dropColumn('release_date');         // Даты выпуска
            $table->dropColumn('lifting_capacity');     // Грузоподъемность
            $table->dropColumn('chassis_configuration'); // Колесная формула
        });
    }
}
