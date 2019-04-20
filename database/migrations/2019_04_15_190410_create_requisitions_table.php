<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('amount');
            $table->string('subject');
            $table->text('reason')->nullable();
            $table->string('supporting_document')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedInteger('requisitor');
            $table->unsignedInteger('firm_id');
            $table->unsignedInteger('status_updated_by')->nullable();
            $table->text('reason_for_update')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');
            $table->foreign('requisitor')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisitions');
    }
}
