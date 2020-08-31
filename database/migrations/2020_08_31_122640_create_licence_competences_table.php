<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenceCompetencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licence_competences', function (Blueprint $table) {
            $table->foreignId('license_id');
            $table->foreignId('competence_id');

            $table->foreign('license_id')->references('id')->on('licenses');
            $table->foreign('competence_id')->references('id')->on('competences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licence_competences');
    }
}
