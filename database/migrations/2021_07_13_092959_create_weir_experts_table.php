<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeirExpertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weir_experts', function (Blueprint $table) {
            $table->id();
            $table->char('weir_id',15)->nullable();
            $table->char('weir_code',20)->nullable();
            $table->text('weir_problem')->nullable();
            $table->text('weir_solution')->nullable();
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
        Schema::dropIfExists('weir_experts');
    }
}
