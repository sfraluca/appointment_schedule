<?php

namespace App\Http\Requests;

use App\Models\WorkingDays;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWorkingDaysRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('working_days_edit');
    }

    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                'integer',
            ],
            'month'        => [
                'required',
                'string:',
            ],
            
            'days' => [
                'required',
                'integer:',
            ],
            'employee_id'  => [
                'required',
                'integer',
            ],
        ];
    }
}
