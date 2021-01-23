<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employee_create');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'nullable',
            ],
            'last_name'  => [
                'string',
                'nullable',
            ],
            'stripe_connect_id' => [
                'string',
                'nullable',
            ],
            'phone'      => [
                'string',
                'nullable',
            ],
        ];
    }
}
