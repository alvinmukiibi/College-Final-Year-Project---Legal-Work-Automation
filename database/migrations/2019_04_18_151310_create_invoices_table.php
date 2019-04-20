<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_no', '8');
            $table->unsignedInteger('rate')->nullable();
            $table->float('time', 8, 4)->nullable();
            $table->float('amount', 8, 2);
            $table->float('balance', 8, 2)->nullable();
            $table->string('reason');
            $table->unsignedInteger('invoicer');
            $table->unsignedInteger('case_id');
            $table->unsignedInteger('firm_id');
            $table->string('status')->default('unpaid');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('invoicer')->references('id')->on('users');
            $table->foreign('case_id')->references('id')->on('legal_cases');
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
        Schema::dropIfExists('invoices');
    }
}
