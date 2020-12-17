<?php

namespace App\Entities;

use App\Models\Employment;
use Illuminate\Support\Facades\Hash;
use Auth;

class RegisterEmployment
{
    public function registerEmployment($params)
    {
        $employment = Employment::create([
            'employee_id' => $params['employee_id'],
            'hour' => $params['hour'],
            'money' => $params['money']
        ]);
        
        return $employment;
    }

    

}