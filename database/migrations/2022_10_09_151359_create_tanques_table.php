<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanques', function (Blueprint $table) {
           // $table->id();
           $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('combustible');
            $table->text('descripcion')->nullable();
            $table->integer('capacidad_max');
            $table->integer('cantidad_disponible');
            $table->integer('cantidad_min')->nullable();
            $table->boolean('estado');
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
        Schema::dropIfExists('tanques');
    }
}
