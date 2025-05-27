<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impovements', function (Blueprint $table) {
            $table->id();
            $table->char('weir_id',15)->nullable();
            $table->char('weir_code',20)->nullable();
            $table->text('weir_amp')->nullable();
            $table->text('improve_type')->nullable();
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
        Schema::dropIfExists('impovements');
    }
}
