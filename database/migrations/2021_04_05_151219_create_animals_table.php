<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** 
         * An animals should include: 
         *      a name, 
         *      date of birth, 
         *      description, 
         *      picture, 
         *      availability. 
         * 
         *      (You could include any other suitable information.)
         * */ 
        Schema::create('animals', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50); // animal name
            $table->date('date_of_birth')->nullable(); // animal date of birth
            $table->string('description', 256)->nullable(); // animal description
            $table->string('image', 256)->nullable(); // animal image
            $table->enum('availability',['available', 'unavailable'])->default('available'); // animal availability
            $table->enum('type',[
                'other',
                'dog',
                'cat',
                'rabbit',
                'hamster',
                'mouse',
                'guinea pig',
                'bird',
                'fish',
                'reptile'
                ]); // animal type
            $table->foreignId('user_id')->nullable()->constrained('users'); // user who adopted the animal

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
        Schema::dropIfExists('animals');
    }
}
