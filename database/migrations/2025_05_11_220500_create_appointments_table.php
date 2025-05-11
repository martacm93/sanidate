<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('doctor_id')->unique();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');

            $table->unsignedBigInteger('patient_id')->unique();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            $table->integer('consultation_hours');
            $table->string('appointment_date');
            $table->string('appointment_time');
            $table->integer('patient_status');
            $table->integer('doctor_status');
            $table->boolean('active')->default(true);
            
            $table->timestamps();
            $table->engine ='InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
