<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegalCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legal_cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('case_no');
            $table->string('category');
            $table->string('description');
            $table->string('date');
            $table->integer('staff_id')->unsigned();
            $table->string('amount');
            $table->text('proceedings')->nullable();
            $table->text('lawyer')->nullable();
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
        Schema::dropIfExists('legal_cases');
    }
}
