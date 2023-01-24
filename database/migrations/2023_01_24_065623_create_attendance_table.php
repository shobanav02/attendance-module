<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('schedule_id'); 
            $table->timestamp('check_in')->nullable()->default(null);
            $table->timestamp('check_out')->nullable()->default(null); 
            $table->string('workedHours')->nullable()->default(0);
            $table->string('breakHours')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('schedule');
            $table->foreign('employee_id')->references('id')->on('employee');
            
        });

        $attendanceData = array(
            [
              'id' => 1,
              'date' => '2023-01-23',
              'employee_id' => 1,
              'schedule_id' => 1,
              'check_in' =>  '2023-01-23 08:00:00.000',
              'check_out' =>  '2023-01-23 18:00:00.000',
              'workedHours' => '08:00' ,
              'breakHours'  => '00:30'
            ],
            [
                'id' => 2,
                'date' => '2023-01-23',
                'employee_id' => 2,
                'schedule_id' => 1,
                'check_in' =>  '2023-01-23 08:00:00.000',
                'check_out' =>  '2023-01-23 18:00:00.000',
                'workedHours' => '08:00' ,
                'breakHours'  => '00:20'
            ],

            );
        DB::table('attendance')->insert($attendanceData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance');
    }
}
