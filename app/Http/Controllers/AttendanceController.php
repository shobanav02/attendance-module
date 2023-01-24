<?php

namespace App\Http\Controllers;
use Nwidart\Modules\Commands\CommandMakeCommand;
use Illuminate\Http\Request;
use App\Src\AppHumanResources\Attendance\Application\AttendanceService;

class AttendanceController extends Controller
{
    
    protected $service;

    public function __construct(AttendanceService $service)
    {
        
        $this->service = $service;
    }

    public function index() {
        
        $attendanceData = $this->service->getAttendanceData();
        return $attendanceData;
    }

    public function store(Request $request) {
        
        $attendance = $this->service->uploadAttendanceData($request->all());
        return $attendance;
    }
}
