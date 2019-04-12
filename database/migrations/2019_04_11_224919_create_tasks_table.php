<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('task');
            $table->string('status')->default('pending');
            $table->unsignedInteger('case_id');
            $table->timestamp('due_date')->useCurrent();
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
        Schema::dropIfExists('tasks');
    }
}
