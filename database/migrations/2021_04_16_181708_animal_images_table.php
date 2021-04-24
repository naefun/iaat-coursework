<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AnimalImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('animal_images', function (Blueprint $table) {
            $table->id();

            $table->string('image', 256)->nullable(); // animal image
            $table->foreignId('animal_id')->constrained('animals')->onDelete('cascade'); // id of the animal this image belongs to

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
        //
        Schema::dropIfExists('animal_images');
    }
}
