<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeirCatchmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weir_catchments', function (Blueprint $table) {
            $table->id();
            $table->char('weir_id',15);
            $table->char('weir_code',20);
            
            $table->float('area')->nullable();
            $table->float('L')->nullable();
            $table->float('LC')->nullable();
            $table->float('H')->nullable();
            $table->float('S')->nullable();
            $table->float('c')->nullable();
            $table->float('I')->nullable();
            $table->float('Return_period')->nullable();
            $table->float('flow')->nullable();
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
        Schema::dropIfExists('weir_catchments');
    }
}
