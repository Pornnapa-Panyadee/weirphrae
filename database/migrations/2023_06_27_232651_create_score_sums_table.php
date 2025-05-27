<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreSumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_sums', function (Blueprint $table) {
            $table->id();
            $table->char('weir_id',15);
            $table->char('weir_code',20);
            
            $table->double('score', 8, 2)->nullable();
            $table->text('class')->nullable();
            $table->smallInteger('state')->nullable();
            $table->smallInteger('N')->nullable();
            $table->smallInteger('Y')->nullable();
            $table->smallInteger('O')->nullable();
            $table->smallInteger('D')->nullable();
            $table->text('amp')->nullable();

            $table->text('class_1')->nullable();
            $table->smallInteger('damage_1')->nullable();
            $table->smallInteger('damage_2')->nullable();
            $table->smallInteger('damage_3')->nullable();
            $table->smallInteger('damage_4')->nullable();
            $table->smallInteger('damage_5')->nullable();
            $table->smallInteger('damage_6')->nullable();

            $table->double('damage_score_1', 8, 2)->nullable();
            $table->double('damage_score_2', 8, 2)->nullable();
            $table->double('damage_score_3', 8, 2)->nullable();
            $table->double('damage_score_4', 8, 2)->nullable();
            $table->double('damage_score_5', 8, 2)->nullable();
            $table->double('damage_score_6', 8, 2)->nullable();
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
        Schema::dropIfExists('score_sums');
    }
}
