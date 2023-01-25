<?php

namespace App\Imports;
use App\Src\AppHumanResources\Attendance\Domain\Attendance;
use Maatwebsite\Excel\Concerns\ToArray;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AttendanceImport implements ToArray
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /**
     * following function will read the date from excel and save it in attendance table
     */
    public function array(array $rows)
    {
       
        foreach ($rows as $index=> $item) {
            if ($index != 0) {
        
              $records = Attendance::create([
                'date' => isset ($item[0]) ? Date::excelToDateTimeObject($item[0])->format('Y-m-d') : null ,
                'employee_id' => $item[1] ,
                'schedule_id' => $item[2] ,
                'check_in' =>  isset ($item[3]) ? Date::excelToDateTimeObject($item[3]) : null,
                'check_out' =>  isset ($item[4]) ? Date::excelToDateTimeObject($item[4]) : null, 
                'workedHours' => isset ($item[5]) ? Date::excelToDateTimeObject($item[5])->format('h:i') : null,
                'breakHours' => isset ($item[6]) ? Date::excelToDateTimeObject($item[6])->format('h:i') : null,
              ]);
           }
        }
    }
}
