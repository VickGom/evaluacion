<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->integer('sku');
            $table->string('articulo');
            $table->string('marca');
            $table->string('modelo');
            $table->integer('departamento');
            $table->integer('clase');
            $table->integer('familia');
            $table->integer('stock');
            $table->integer('cantidad');
            $table->integer('descontinuado');
            $table->date('fechaDeAlta');
            $table->date('fechaBaja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
