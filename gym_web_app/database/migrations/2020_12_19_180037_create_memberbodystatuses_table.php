<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberbodystatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberbodystatuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id');
            $table->string('weight');
            $table->string('height');
            $table->string('chest');
            $table->string('stomach');
            $table->string('biceps');
            $table->string('thighs');
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
        Schema::dropIfExists('memberbodystatuses');
    }
}
