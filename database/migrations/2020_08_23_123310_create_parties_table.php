<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("surname")->nullable();
            $table->string("father_name")->nullable();
            $table->string("national_id")->nullable();
            $table->string("mobile_number")->nullable();
            $table->string("sacrifice_id")->nullable();
            $table->string("birth_certificate_id")->nullable();
            $table->string("birth_certificate_series")->nullable();
            $table->string("birth_certificate_serial_no")->nullable();
            $table->dateTime("birth_date")->nullable();
            $table->string("birth_country")->nullable();
            $table->string("birth_city")->nullable();
            $table->string("birth_certificate_issued_place")->nullable();
            $table->string("marital_status")->nullable();
            $table->string("email_address")->nullable();
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
        Schema::dropIfExists('parties');
    }
}
