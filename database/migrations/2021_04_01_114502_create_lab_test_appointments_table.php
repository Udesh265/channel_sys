<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabTestAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_test_appointments', function (Blueprint $table) {
            $table->id();
            $table->dateTime("date");
            $table->integer('user_id');
            $table->integer('payment_id');
            $table->integer('patient_id');
            $table->integer("report_type_id");
            $table->string("appointment_type"); // registered or regular
            $table->string('status');
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
        Schema::dropIfExists('lab_test_appointments');
    }
}
