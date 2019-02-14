<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('fname', '50');
            $table->string('mname', '50');
            $table->string('lname', '50');
            $table->string('email', '100');
            $table->text('password')->nullable();
            $table->string('contact', '20');
            $table->string('date_of_birth', '15')->nullable();
            $table->string('profile_pic', '50')->nullable();
            $table->timestamp('date_of_reg');
            $table->enum('gender', ['Male','Female']);
            $table->string('department', '100');
            $table->string('user_role', '50');
            $table->string('account_status', '20');
            $table->integer('firm_id')->nullable();
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
        Schema::dropIfExists('users');
    }
}
