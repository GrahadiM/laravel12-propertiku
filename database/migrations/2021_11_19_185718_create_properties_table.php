<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('category_id')->constrained();
            $table->bigInteger('category_id');
            $table->string('name'); // Nama Properti (ex: Cluster Lavender)
            $table->string('slug')->unique();
            $table->string('location'); // Alamat/Lokasi
            $table->integer('price');
            $table->text('description');
            $table->integer('bedroom')->default(0);
            $table->integer('bathroom')->default(0);
            $table->string('surface_area'); // Luas Tanah
            $table->string('building_area'); // Luas Bangunan
            $table->string('certificate')->nullable(); // SHM, HGB, dll
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
        Schema::dropIfExists('properties');
    }
}
