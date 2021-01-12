@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appointment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.employment.fields.id') }}
                        </th>
                        <td>
                            {{ $employment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employment.fields.employee') }}
                        </th>
                        <td>
                            {{ $employment->employee->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employment.fields.hour') }}
                        </th>
                        <td>
                            {{ $employment->hour }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employment.fields.money') }}
                        </th>
                        <td>
                            {{ $appointment->money }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection