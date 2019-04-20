<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');
            $table->float('time', 8, 4);
            $table->string('event');
            $table->unsignedInteger('case_id');
            $table->unsignedInteger('added_by');
            $table->unsignedInteger('firm_id');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('case_id')->references('id')->on('legal_cases');
            $table->foreign('added_by')->references('id')->on('users');
            $table->foreign('firm_id')->references('id')->on('firms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('times');
    }
}
