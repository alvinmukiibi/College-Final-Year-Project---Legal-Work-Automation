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
            $table->increments('id');
            $table->string('case_number'); //e.g 200604
            $table->unsignedInteger('client');
            $table->unsignedInteger('staff'); // open, closed, etc
            $table->string('case_type'); //e.g PER, CORP, etc
            $table->string('date_taken');
            $table->string('taken_by'); // e.g. partner, associate etc i.e. the role
            $table->text('synopsis'); // description of case by client
            $table->string('case_status'); // open, closed, etc
            $table->text('firm'); // firm identification number
            $table->timestamp('created_at')->useCurrent();


            //$table->foreign('firm')->references('firm_id')->on('firms');
            $table->foreign('staff')->references('id')->on('users');
            $table->foreign('client')->references('id')->on('clients')->onDelete('cascade');



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
