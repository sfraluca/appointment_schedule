<?php

namespace App\Http\Requests;

use App\Models\Employment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmploymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employment_edit');
    }

    public function rules()
    {
        return [
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
