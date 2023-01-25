<?php
 
namespace App\Src\AppHumanResources\Attendance\Domain;
 
use Illuminate\Database\Eloquent\Model;
 
class Attendance extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attendance';

    protected $fillable = ['date' ,'employee_id' ,'schedule_id' , 'check_in','check_out' , 'workedHours' , 'breakHours'];

    public function employee()
     {
         return $this->hasOne('App\Src\AppHumanResources\Attendance\Domain\Employee', 'id', 'employee_id');
     }
}