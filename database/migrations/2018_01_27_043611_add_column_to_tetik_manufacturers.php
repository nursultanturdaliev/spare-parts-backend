<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToTetikManufacturers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tetik_manufacturers', function (Blueprint $table) {
            $table->unsignedInteger('catalog_type_id')->nullable(true);
            $table->foreign('catalog_type_id')
                ->references('id')->on('tetik_catalog_types')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tetik_manufacturers', function (Blueprint $table) {
            $table->dropColumn('catalog_type_id');
        });
    }
}
