<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $enumTypes = [''];

    public function up()
    {
        Schema::create('documentables', function (Blueprint $table) {
            $table->id();
            $table->foreignId("document_id")->nullable();
            $table->nullableMorphs('documentable');
            $table->enum('type' , $this->enumTypes);
            $table->timestamps();

            $table->foreign("document_id")->references("id")->on("documents");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentables');
    }
}
