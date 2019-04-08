<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname','50');
            $table->string('lname','50');
            $table->string('nationality','100');
            $table->string('address','100')->nullable();
            $table->string('district_of_residence','100');
            $table->string('city_of_residence','100');
            $table->string('mobile_contact','20');
            $table->string('work_contact','20');
            $table->string('email','100');
            $table->text('password')->nullable();
            $table->string('organization','50');
            $table->timestamp('date_of_reg')->useCurrent();
            $table->string('date_of_birth','50');
            $table->string('marital_status','50');
            $table->string('nin','100');
            $table->string('file_number','20');
            $table->string('firm_id','50');





        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
