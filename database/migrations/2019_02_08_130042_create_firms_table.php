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
            $table->string('firm_id','50');
            $table->text('name');
            $table->string('email','100')->unique();
            $table->string('contact1','100');
            $table->string('contact2','100');
            $table->text('password');
            $table->string('country','100');
            $table->string('area','100');
            $table->string('city','50');
            $table->text('street_address');
            $table->text('practice_groups');
            $table->timestamp('date_of_reg');
            $table->string('avatar','100');
            $table->text('website');
            $table->text('description');
            $table->string('activity_flag','10');
            $table->string('verification_flag','10');
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
