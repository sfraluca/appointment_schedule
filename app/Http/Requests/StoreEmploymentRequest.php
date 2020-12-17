<?php

namespace App\Http\Requests;

use App\Models\Employment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmploymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employment_create');
    }

    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                'integer',
            ],
            'hour' => [
                'integer',
                'nullable',
            ],
            'money'  => [
                'integer',
                'nullable',
            ],
        ];
    }
}
