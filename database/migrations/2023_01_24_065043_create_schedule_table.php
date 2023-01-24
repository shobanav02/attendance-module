<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->unsignedBigInteger('shift_id');
            $table->unsignedBigInteger('location_id');
            $table->timestamps();

            $table->foreign('shift_id')->references('id')->on('shifts');
            $table->foreign('location_id')->references('id')->on('location');

        
        });

        $scheduleData = array(
            [
              'id' => 1,
              'name' => 'Schedule 1',
              'shift_id' => 1 ,
              'location_id' => 1,
            ],
            [
              'id' => 2,
              'name' => 'Schedule 2',
              'shift_id' => 2 ,
              'location_id' => 1,
            ],

            );
        DB::table('schedule')->insert($scheduleData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
}
