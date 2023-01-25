<?php

namespace App\Src\AppHumanResources\Attendance\Application;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Src\AppHumanResources\Attendance\Domain\Attendance;
use Nwidart\Modules\Commands\CommandMakeCommand;
use App\Imports\AttendanceImport;

class AttendanceService
{
     /**
     * following function get the attendance data from the table
     * 
     */
    public function getAttendanceData()
    {
        $attendanceData = Attendance::with('employee')->get();

        return $attendanceData;

    }
    /**
     * following function get the data from excel and store it in table
     * 
     */
    public function uploadAttendanceData($data) {
       $fileData = base64_decode($data['data']);

        Storage::disk('local')->put($data['fileName'],$fileData);
     
        Excel::import(new AttendanceImport , $data['fileName']) ;
    
    }
    
}
