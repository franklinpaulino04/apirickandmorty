<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('status', ['Dead', 'Alive', 'unknown'])->default('unknown');
            $table->enum('species', ['Alien', 'unknown', 'Human'])->default('unknown');
            $table->string('type')->nullable();
            $table->enum('gender', ['Female', 'Male', 'unknown'])->default('unknown');
            $table->string('origin_id')->default(0)->nullable();
            $table->string('location_id')->default(0)->nullable();
            $table->string('image')->nullable();

            $table->index('id');
            $table->index('origin_id');
            $table->index('location_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
