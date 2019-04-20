<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meeting_id');
            $table->unsignedInteger('attendee_1')->nullable();
            $table->unsignedInteger('attendee_2')->nullable();
            $table->unsignedInteger('attendee_3')->nullable();
            $table->unsignedInteger('attendee_4')->nullable();
            $table->unsignedInteger('attendee_5')->nullable();

            $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('cascade');

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
        Schema::dropIfExists('meeting_attendances');
    }
}
