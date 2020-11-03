<?php

namespace App\Http\Requests;

use App\Models\WorkingHour;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWorkingHourRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('working_hour_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:working_hours,id',
        ];
    }
}
