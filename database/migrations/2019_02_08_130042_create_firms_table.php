<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firms', function (Blueprint $table) {
            $table->increments('id');
            $table->text('firm_id');
            $table->text('name');
            $table->string('email','100')->unique();
            $table->string('contact1','100');
            $table->string('contact2','100')->nullable();
            $table->text('password')->nullable();
            $table->string('country','100');
            $table->string('area','100');
            $table->string('city','50');
            $table->text('street_address');
            //$table->text('practice_groups')->nullable();
            $table->timestamp('date_of_reg');
            $table->string('avatar','100')->nullable();
            $table->text('website')->nullable();
            $table->text('description')->nullable();
            $table->text('uuid')->nullable();
            $table->string('activity_flag','10')->nullable();
            $table->string('verification_flag','10')->nullable();
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
        Schema::dropIfExists('firms');
    }
}
