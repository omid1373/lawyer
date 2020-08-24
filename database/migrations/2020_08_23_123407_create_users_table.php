<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("party_id")->nullable();
            $table->date('contract_agreement_date')->nullable();
            $table->string("inquiry_reference")->nullable(); // مرجع صدور
            $table->dateTime("inquiry_date")->nullable();
            $table->timestamps();

            $table->foreign("party_id")->references("id")->on("parties");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
