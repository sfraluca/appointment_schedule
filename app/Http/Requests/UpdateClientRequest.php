<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_edit');
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
            'phone'      => [
                'string',
                'nullable',
            ],
        ];
    }
}
