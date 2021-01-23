@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appointment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.working_days.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $workingsDays->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Lună
                        </th>
                        <td>
                            {{ $workingsDays->month }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Zile
                        </th>
                        <td>
                            {{ $workingsDays->days }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Angajați
                        </th>
                        <td>
                            {{ $workingsDays->employee->first_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.working_days.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection