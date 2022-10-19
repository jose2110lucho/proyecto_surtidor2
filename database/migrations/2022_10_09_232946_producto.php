<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Producto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre');
            $table->decimal('precio_compra', 8,2);
            $table->decimal('precio_venta',8,2);
            $table->boolean('estado')->default(true);
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->string('nombre_imagen');
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
        Schema::dropIfExists('producto');
    }
}
