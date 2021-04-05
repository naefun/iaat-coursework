<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** (From functional requirements)
         * Make an adoption request. 
         * View all the adoption requests made by this user and whether the requests have been:
         *      approved
         *      denied
         *      pending
         */

        Schema::create('adoption_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users'); // user who made adoption request
            $table->foreignId('animal_id')->constrained('animals'); // animal that the user is requesting to adopt
            $table->enum('request_status',['approved', 'denied', 'pending'])->default('pending'); // request status

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
        Schema::dropIfExists('adoption_requests');
    }
}
