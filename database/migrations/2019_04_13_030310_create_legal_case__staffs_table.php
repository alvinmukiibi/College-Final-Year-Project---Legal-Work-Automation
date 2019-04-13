<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegalCaseStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legal_case__staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('case_id');
            $table->unsignedInteger('owner');
            $table->unsignedInteger('referee1')->nullable();
            $table->unsignedInteger('referee2')->nullable();
            $table->unsignedInteger('assignee')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('case_id')->references('id')->on('legal_cases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legal_case__staffs');
    }
}
