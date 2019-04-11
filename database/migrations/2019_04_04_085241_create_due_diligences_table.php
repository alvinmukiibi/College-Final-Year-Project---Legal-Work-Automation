<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDueDiligencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('due_diligences', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();
            $table->string('date_carried_out');
            $table->text('file1')->nullable();
            $table->text('file2')->nullable();
            $table->text('file3')->nullable();
            $table->text('file4')->nullable();
            $table->text('file5')->nullable();
            $table->string('case_id');
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
        Schema::dropIfExists('due_diligences');
    }
}
