<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_weights', function (Blueprint $table) {
            $table->id();

            $table->double('part1', 8, 2)->nullable();
            $table->double('part2', 8, 2)->nullable();
            $table->double('part3', 8, 2)->nullable();
            $table->double('part4', 8, 2)->nullable();
            $table->double('part5', 8, 2)->nullable();
            $table->double('part6', 8, 2)->nullable();

            $table->text('point')->nullable();
            $table->smallInteger('devide')->nullable();

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
        Schema::dropIfExists('score_weights');
    }
}
