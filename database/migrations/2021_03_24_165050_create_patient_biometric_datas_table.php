<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientBiometricDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_biometric_datas', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->string('diseases');
            $table->string('weight');
            $table->string('height');
            $table->string('bp');
            $table->string('lp');
            $table->string('others');

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
        Schema::dropIfExists('patient_biometric_datas');
    }
}
