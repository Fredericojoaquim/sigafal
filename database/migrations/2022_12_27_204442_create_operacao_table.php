<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operacao', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conta_id')->unsigned();
            $table->double('debito');
            $table->double('credito');
            $table->date('data');
            $table->foreign('conta_id')->references('id')->on('contaclientes');
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
        Schema::dropIfExists('operacao');
    }
}
