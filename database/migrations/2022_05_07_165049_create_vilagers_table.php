<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVilagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vilagers', function (Blueprint $table) {
            $table->id();   
            $table->string('name');
            $table->string('nik');
            $table->string('kk');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('status');
            $table->string('religion');
            $table->string('education');
            $table->string('job');
            $table->string('gender');
            $table->string('rt'); 
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
        Schema::dropIfExists('vilagers');
    }
}
