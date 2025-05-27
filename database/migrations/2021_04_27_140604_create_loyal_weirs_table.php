<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyalWeirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyal_weirs', function (Blueprint $table) {
            $table->id();
            $table->text('weir_name')->nullable();            
            $table->text('weir_type')->nullable();            
            $table->text('weir_size')->nullable();
            $table->text('weir_status')->nullable();
            $table->text('tambol')->nullable();
            $table->text('district')->nullable();
            $table->text('province')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();

            $table->text('weir_idea_year')->nullable();
            $table->text('weir_receive_year')->nullable();
            $table->text('weir_king_of')->nullable();
            $table->text('weir_law')->nullable();
            $table->text('weir_start_year')->nullable();
            $table->text('weir_finish_year')->nullable();
            $table->text('weir_storage')->nullable();
            $table->text('weir_area')->nullable();
            $table->text('weir_use')->nullable();
            $table->text('family')->nullable();
            $table->char('weir_system',2)->nullable();
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
        Schema::dropIfExists('loyal_weirs');
    }
}
