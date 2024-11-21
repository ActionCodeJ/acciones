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
        Schema::table('entities', function (Blueprint $table) {
            $table->timestamps(); // Agrega las columnas created_at y updated_at
        });

        Schema::table('departamentos', function (Blueprint $table) {
            $table->timestamps(); // Agrega las columnas created_at y updated_at
        });
        Schema::table('actions_teams', function (Blueprint $table) {
            $table->timestamps(); // Agrega las columnas created_at y updated_at
        });
        Schema::table('actions_entities', function (Blueprint $table) {
            $table->timestamps(); // Agrega las columnas created_at y updated_at
        });
        Schema::table('actions_categories', function (Blueprint $table) {
            $table->timestamps(); // Agrega las columnas created_at y updated_at
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->timestamps(); // Agrega las columnas created_at y updated_at
        });
        Schema::table('teams', function (Blueprint $table) {
            $table->timestamps(); // Agrega las columnas created_at y updated_at
        });
       
    }
/*
    public function down()
    {
        Schema::table('localidades', function (Blueprint $table) {
            $table->dropTimestamps(); // Elimina las columnas
        });
    }*/
};
