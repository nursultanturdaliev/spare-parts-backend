<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tetik_products', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('spare_part_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('user_id')->references('id')->on('tetik_users')->onDelete('cascade');
            $table->foreign('spare_part_id')->references('id')->on('tetik_spare_parts')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tetik_products');
    }
}
