<?php

namespace App\Entities;

use App\Models\Salaries;
use Illuminate\Support\Facades\Hash;
use Auth;

class RegisterSalary
{
    public function registerSalary($params)
    {
        $salary = Salaries::create([
            'employee_id' => $params['employee_id'],
            'employee' => $params['employee'],
            'month' => $params['month'],
            'hours' => $params['hours'],
            'salary' => $params['salary']

        ]);
        return $salary;
    }

    

}