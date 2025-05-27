<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidWeirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rid_weirs', function (Blueprint $table) {
            $table->id();
            $table->text('weir_name')->nullable();
            $table->text('weir_detail')->nullable();
            $table->char('moo',3)->nullable();
            $table->text('village')->nullable();
            $table->text('tambol')->nullable();
            $table->text('district')->nullable();
            $table->text('province')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->text('budget_from')->nullable();
            $table->text('weir_type')->nullable();
            $table->text('weir_area')->nullable();
            $table->text('weir_use')->nullable();
            $table->text('weir_storage')->nullable();
            $table->text('weir_system')->nullable();
            $table->text('weir_build_year')->nullable();
            $table->text('weir_tranfer_year')->nullable();
            $table->text('weir_tranfer_unit')->nullable();
            $table->text('weir_tranfer_status')->nullable();
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
        Schema::dropIfExists('rid_weirs');
    }
}
