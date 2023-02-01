<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('type', ['Microverse', 'TV', 'Resort', 'unknown', 'Dream', 'Planet', 'Cluster', 'Fantasy town', 'Space station'])->default('unknown');
            $table->enum('dimension', ['Cronenberg Dimension', 'Replacement Dimension', 'Dimension C-137', 'Dimension 5-126', 'Fantasy Dimension', 'unknown'])->default('unknown');

            $table->index('id');
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
        Schema::dropIfExists('locations');
    }
}
