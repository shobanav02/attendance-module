<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employeeNumber');
            $table->string('name');
            $table->unsignedBigInteger('schedule_id');
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('schedule');

        });

        $employeeData = array(
            [
               'id' => 1,
               'employeeNumber' => '1001',
               'name' => 'John Dave',
               'schedule_id' => 1
            ],
            [
                'id' => 2,
                'employeeNumber' => '1002',
                'name' => 'Anto',
                'schedule_id' => 2
            ],
            [
                'id' => 3,
                'employeeNumber' => '1003',
                'name' => 'Bradley',
                'schedule_id' => 1
            ],
            [
                'id' => 4,
                'employeeNumber' => '1004',
                'name' => 'Peter',
                'schedule_id' => 2
            ],
            );
        DB::table('employee')->insert($employeeData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
