<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//    public function up()
//    {
//        Schema::create('lawyers', function (Blueprint $table) {
//            $table->id();
//            $table->string('')->nullable();
//            $table->string('')->nullable();
//            $table->string('')->nullable();
//            $table->string('')->nullable();
//            $table->foreignId("experience_id")->nullable();
//            $table->timestamps();
//
//            $table->foreign("experience_id")->references("id")->on("experiences");
//        });
//    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lawyers');
    }
}
