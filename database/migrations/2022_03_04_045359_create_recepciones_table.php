<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('recepcionista_id');
            $table->unsignedBigInteger('equipo_id');
            $table->unsignedBigInteger('estado_id');
            
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('recepcionista_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');
            
            $table->string('falla')->not_null();
            $table->string('accesorio')->nullable();
            $table->timestamp('fecha_recepcion')->not_null();
            $table->timestamp('fecha_entrega')->nullable();
            $table->string('informe_final')->nullable();
            $table->text('observacion')->nullable();
            $table->double('precio',9,2)->nullable();
            $table->date('garantia')->nullable();
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

