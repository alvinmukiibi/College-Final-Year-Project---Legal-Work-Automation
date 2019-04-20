<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProceedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceedings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();
            $table->string('date_of_proceeding');
            $table->string('court_of_proceeding', '100');
            $table->text('outcome_of_proceeding')->nullable();
            $table->string('date_of_next_proceeding')->nullable();
            $table->unsignedInteger('case_id');
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
        Schema::dropIfExists('proceedings');
    }
}
