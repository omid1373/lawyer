<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licences', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable();
            $table->string("licence_number")->nullable();
            $table->string("expertise")->nullable();
//            $table->dateTime("issued_date")->nullable(); -> From
//            $table->dateTime("expiration_date")->nullable(); -> To
            $table->integer("suggested_tasks_number")->nullable();
            $table->integer("proposed_tasks_number")->nullable();
            $table->integer("in_progress_tasks_number")->nullable();
            $table->integer("rejected_tasks_number")->nullable();
            $table->integer("completed_tasks_number")->nullable();
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licences');
    }
}
