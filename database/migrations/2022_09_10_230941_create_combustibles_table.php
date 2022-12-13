<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombustiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combustibles', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre')->nulleable(false);
            $table->decimal('precio_compra')->nulleable(false);
            $table->decimal('precio_venta');
            $table->string('unidad_medida')->nulleable(false);
            $table->foreignId('categoria_id','id')->nulleable()
            ->constrained('categorias')
            ->on('categorias')
            ->onDelete('cascade');
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
        Schema::dropIfExists('combustibles');
    }
}