<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecepcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepciones', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('id_recepcionista')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_equipo')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('id_estado')->references('id')->on('estados')->onDelete('cascade');
            $table->string('estado_equipo')->not_null();
            $table->string('falla')->not_null();
            $table->string('accesorio')->nullable();
            $table->date('fecha_recepcion')->not_null();
            $table->date('fecha_entrega')->not_null();
            $table->string('informe_final')->not_null();
            $table->string('observación')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('recepciones');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
