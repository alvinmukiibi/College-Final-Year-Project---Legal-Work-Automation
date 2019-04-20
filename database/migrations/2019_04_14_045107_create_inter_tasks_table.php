<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inter_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator');
            $table->text('task');
            $table->string('deadline')->nullable();
            $table->string('completion_status')->default('pending');
            $table->unsignedInteger('assignee');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inter_tasks');
    }
}
