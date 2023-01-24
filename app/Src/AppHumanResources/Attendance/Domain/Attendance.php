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


    public function employee()
     {
         return $this->hasOne('App\Src\AppHumanResources\Attendance\Domain\Employee', 'id', 'employee_id');
     }
}