<?php

namespace App\Http\Requests;

use App\Models\WorkingDays;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWorkingDaysRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('working_days');
    }

    public function rules()
    {
        return [
            'month' => [
                'text',
                'nullable',
            ],
            'days'  => [
                'integer',
                'nullable',
            ],
        ];
    }
}
