<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('case_id');
            $table->unsignedBigInteger('amount');
            $table->string('paid_by');
            $table->string('paid_for');
            $table->string('ref', '6')->unique();
            $table->timestamp('date_of_payment')->useCurrent();
            $table->unsignedInteger('received_by');
            $table->string('status', '50')->default('pending');
            $table->unsignedInteger('firm_id');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('case_id')->references('id')->on('legal_cases');
            $table->foreign('received_by')->references('id')->on('users');
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
        Schema::dropIfExists('payments');
    }
}
