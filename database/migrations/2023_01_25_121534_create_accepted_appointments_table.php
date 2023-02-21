<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcceptedAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accepted_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pa_id');
            $table->foreign('pa_id')->references('id')->on('users');
            $table->unsignedBigInteger('dr_id');
            $table->foreign('dr_id')->references('id')->on('doctors');
            $table->string('day');
            $table->string('begin_hour');
            $table->string('end_hour');
            $table->string('duration');
            $table->string('status');
            $table->string('type');
            $table->string('done');
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
        Schema::dropIfExists('accepted_appointments');
    }
}
