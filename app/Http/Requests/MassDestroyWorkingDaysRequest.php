<?php

namespace App\Http\Requests;

use App\Models\WorkingDays;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWorkingDaysRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('working_days_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:working_days,id',
        ];
    }
}
