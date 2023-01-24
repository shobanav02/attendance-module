<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class AttendanceSummaryService
{
    

    private $payrollService;

    public function __construct(PayrollService $payrollService)
    {
        $this->payrollService = $payrollService;
    }

    public function getSettings()
    {
        $settings = Conf::where('conf_code', '=', 'att_summary_settings')->first();
        if ($settings) {
            $settings = json_decode($settings->value);
            return [
                'isEnabled' => isset($settings->enabled) ? $settings->enabled : false,
                'emails' => isset($settings->emails) ? $settings->emails : []
            ];
        } else {
            return [
                'isEnabled' => false,
                'emails' => []
            ];
        }
    }

    
}
