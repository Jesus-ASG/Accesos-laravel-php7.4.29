<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('espacio_id')->nullable();
            
            $table->foreign('estudiante_id')
                ->references('id')->on('estudiantes')
                ->onDelete('cascade');
            
            $table->foreign('espacio_id')
                ->references('id')->on('espacios')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesos');
    }
};

