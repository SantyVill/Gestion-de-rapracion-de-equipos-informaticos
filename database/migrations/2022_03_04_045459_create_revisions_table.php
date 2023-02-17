<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tecnico_id')->nullable();
            $table->unsignedBigInteger('recepcion_id');
            $table->foreign('tecnico_id')->references('id')->on('users');
            $table->foreign('recepcion_id')->references('id')->on('recepciones')->onDelete('cascade');
            $table->text('nota')->nullable();
            $table->timestamp('fecha')->nullable();
 //           $table->text('Observación');
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
        Schema::dropIfExists('revisions');
    }
}
