<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->decimal('noOfDay', 10, 2)->nullable()->default(null); // can be 1 day or 0.5 day
            $table->string('startTime')->nullable();
            $table->string('endTime')->nullable();
            $table->string('workHours')->nullable();
            $table->string('breakTime')->nullable();
            $table->boolean('hasMidnightCrossOver')->default(false);
            $table->string('halfDayLength')->nullable();
            $table->string('gracePeriod')->nullable();
            $table->boolean('isOTEnabled')->default(false);
            $table->boolean('inOvertime')->default(false);
            $table->boolean('outOvertime')->default(false);
            $table->boolean('deductLateFromOvertime')->default(false);
            $table->string('minimumOT')->nullable();
            $table->timestamps();
        });

        $shiftData = array(
            [
              'id' => 1,
              'name' => 'General',
              'noOfDay' => '1',
              'startTime' => '08:00',
              'endTime' => '17:00',
              'workHours' => '580' , //in minutes
              'breakTime' => '30' , //in minutes
              'hasMidnightCrossOver' => false,
              'halfDayLength' => '04:30',
              'gracePeriod' => '30', //in min
              'isOTEnabled' => false ,
              'inOvertime' => false ,
              'outOvertime' => true ,
              'deductLateFromOvertime' => false ,
              'minimumOT' => 60 
            ],
            [
              'id' => 2,
              'name' => 'UK shift',
              'noOfDay' => '1',
              'startTime' => '14:00',
              'endTime' => '23:00',
              'workHours' => '580' , //in minutes
              'breakTime' => '30' , //in minutes
              'hasMidnightCrossOver' => false,
              'halfDayLength' => '04:30',
              'gracePeriod' => '30' ,//in min
              'isOTEnabled' => false ,
              'inOvertime' => false ,
              'outOvertime' => true ,
              'deductLateFromOvertime' => false ,
              'minimumOT' => 60 
            ]
            );
        DB::table('shifts')->insert($shiftData);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}
