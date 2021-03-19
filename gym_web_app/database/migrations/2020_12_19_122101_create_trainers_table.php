<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('image')->default('no');
            $table->string('fullname');
            $table->string('phone');
            $table->string('address'); 
            $table->boolean('shift_m')->default(false); //shift_morning
            $table->boolean('shift_e')->default(false); //shift_evening
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
        Schema::dropIfExists('trainers');
    }
}
