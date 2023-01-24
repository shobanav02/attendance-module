<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceFaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_faults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('attendance_id'); 
            $table->timestamp('check_in')->nullable()->default(null);
            $table->timestamp('check_out')->nullable()->default(null); 
            $table->integer('workedHours')->nullable()->default(0);
            $table->integer('breakHours')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('attendance_id')->references('id')->on('attendance');
            $table->foreign('employee_id')->references('id')->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_faults');
    }
}
