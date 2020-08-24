<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judges', function (Blueprint $table) {
            $table->id();
            $table->foreignId("experience_id")->nullable();
            $table->string('organization')->nullable();
            $table->string('branch')->nullable();
            $table->boolean('is_Judiciary')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('termination_reason')->nullable();
            $table->timestamps();

            $table->foreign("experience_id")->references("id")->on("experiences");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('judges');
    }
}
