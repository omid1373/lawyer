<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $address_types = ['home' , 'work', 'licence'];

    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("party_id")->nullable();
            $table->enum("type",$this->address_types)->nullable();
            $table->string("country")->default('Islamic Republic of Iran');
            $table->string("province")->nullable();
            $table->string("town")->nullable();
            $table->string("city")->nullable();
            $table->string("zip_code")->nullable();
            $table->string("address")->nullable();
            $table->dateTime("residence_start_date")->nullable();
            $table->string("city_code")->nullable();
            $table->string("telephone_number")->nullable();
            $table->timestamps();

            $table->index('type');

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
        Schema::dropIfExists('addresses');
    }
}
