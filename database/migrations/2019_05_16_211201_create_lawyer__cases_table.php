<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLawyerCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analytics_lawyer__cases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lawyer');
            $table->unsignedBigInteger('intakes')->default(0);
            $table->unsignedBigInteger('open_cases')->default(0);
            $table->unsignedBigInteger('closed_cases')->default(0);
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
        Schema::dropIfExists('lawyer__cases');
    }
}
