@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.workingHour.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.working-hours.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.workingHour.fields.id') }}
                        </th>
                        <td>
                            {{ $workingHour->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workingHour.fields.employee') }}
                        </th>
                        <td>
                            {{ $workingHour->employee->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workingHour.fields.date') }}
                        </th>
                        <td>
                            {{ $workingHour->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workingHour.fields.start_time') }}
                        </th>
                        <td>
                            {{ $workingHour->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workingHour.fields.finish_time') }}
                        </th>
                        <td>
                            {{ $workingHour->finish_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workingHour.fields.project') }}
                        </th>
                        <td>
                            {{ $workingHour->project->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.working-hours.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection