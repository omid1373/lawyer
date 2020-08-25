<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudgementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judgements', function (Blueprint $table) {
            $table->id();
            $table->string('organization')->nullable();
            $table->string('branch')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('termination_reason')->nullable();
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
        Schema::dropIfExists('judgements');
    }
}
