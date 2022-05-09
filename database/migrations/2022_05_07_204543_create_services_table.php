<?php

use App\Models\Vilager;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();            
            // $table->foreignIdFor(Vilager::class)->constrained()->nullOnDelete();
        // $table->foreignId('vilager_id')->references('vilagers')->cascadeOnDelete()->constrained();
            //$table->foreignId('')
            //  $table->foreignIdFor(Vilager::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('vilager_id');
            $table->foreign('vilager_id')->on('vilagers')->references('id')->constrained()->cascadeOnDelete();
            $table->string('topic');
            $table->string('content');           
            $table->string('status');
            $table->string('contact');            
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
        Schema::dropIfExists('services');
    }
}
