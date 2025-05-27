<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToComponantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('upprotection_invs', function (Blueprint $table) {
            $table->text('section_status')->nullable();
        });

        Schema::table('upconcrete_invs', function (Blueprint $table) {
            $table->text('section_status')->nullable();
        });

        Schema::table('control_invs', function (Blueprint $table) {
            $table->text('section_status')->nullable();
        });

        Schema::table('downconcrete_invs', function (Blueprint $table) {
            $table->text('section_status')->nullable();
        });

        Schema::table('downprotection_invs', function (Blueprint $table) {
            $table->text('section_status')->nullable();
        });

        Schema::table('waterdelivery_invs', function (Blueprint $table) {
            $table->text('section_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('componant', function (Blueprint $table) {
            //
        });
    }
}
