<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDwrWeirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dwr_weirs', function (Blueprint $table) {
            $table->id();
            $table->text('weir_name')->nullable();
            $table->char('moo',3)->nullable();
            $table->text('village')->nullable();
            $table->text('tambol')->nullable();
            $table->text('district')->nullable();
            $table->text('province')->nullable();
            $table->text('river')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->text('weir_area')->nullable();
            $table->text('weir_build_year')->nullable();
            $table->char('weir_use',2)->nullable();

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
        Schema::dropIfExists('dwr_weirs');
    }
}
