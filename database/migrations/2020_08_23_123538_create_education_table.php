<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $grades = ['bachelor', 'masters' , 'phd' , 'hawzeh'];

    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable();
            $table->enum('grade', $this->grades)->nullable();
            $table->string('field')->nullable();
            $table->string('subfield')->nullable(); // todo : subfield->'Gerayesh'
            $table->float('average')->nullable();
            $table->integer('from')->nullable();
            $table->integer('to')->nullable();
            $table->boolean('pending')->nullable();
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
        Schema::dropIfExists('education');
    }
}
