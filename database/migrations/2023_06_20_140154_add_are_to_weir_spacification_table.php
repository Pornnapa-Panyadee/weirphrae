<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAreToWeirSpacificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weir_spaceifications', function (Blueprint $table) {
            $table->text('benefit_area')->nullable();
            $table->text('comsumption')->nullable();
            $table->text('agriculture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weir_spacification', function (Blueprint $table) {
            //
        });
    }
}
