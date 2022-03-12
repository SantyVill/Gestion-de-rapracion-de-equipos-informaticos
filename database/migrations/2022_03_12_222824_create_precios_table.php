<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('caracteristica_id');
            $table->foreign('caracteristica_id')->references('id')->on('caracteristicas')->onDelete('cascade');

            $table->string('reparacion')->not_null();
            $table->double('precio',9,2)->not_null();
            $table->date('plazo')->not_null();
            $table->string('riesgo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precios');
    }
}