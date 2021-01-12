<?php

namespace App\Entities;

use App\Models\WorkingDays;
use Illuminate\Support\Facades\Hash;
use Auth;

class RegisterWorkingDays
{
    public function registerWorkingDays($params)
    {
        $working_days = WorkingDays::create([
            'employee_id' => $params['employee_id'],
            'month' => $params['month'],
            'days' => $params['days']
        ]);
        
        return $working_days;
    }

    

}