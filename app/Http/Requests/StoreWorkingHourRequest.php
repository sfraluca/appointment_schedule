<?php

namespace App\Http\Requests;

use App\Models\WorkingHour;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWorkingHourRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('working_hour_create');
    }

    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                'integer',
            ],
            'date'        => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'start_time'  => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'finish_time' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'project_id'  => [
                'required',
                'integer',
            ],
        ];
    }
}
