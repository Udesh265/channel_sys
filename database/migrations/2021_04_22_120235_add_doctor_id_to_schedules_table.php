<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoctorIdToSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // php artisan make:migration add_doctor_id_to_schedules_table --table=schedules


    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('doctor_id');
        });
    }
}
