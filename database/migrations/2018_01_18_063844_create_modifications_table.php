<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('modification_type_id');
            $table->unsignedInteger('model_designation_id');
            $table
                ->foreign('modification_type_id')
                ->references('id')
                ->on('modification_types')
                ->onDelete('cascade');

            $table->foreign('model_designation_id')
                ->references('id')
                ->on('model_designations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modifications');
    }
}
