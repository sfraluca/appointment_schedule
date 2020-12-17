@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.employment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employments.update", [$employment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="employee_id">{{ trans('cruds.employment.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $employee)
                        <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $employment->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $employee }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employee') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employment.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hour">{{ trans('cruds.employment.fields.hour') }}</label>
                <input class="form-control integer {{ $errors->has('hour') ? 'is-invalid' : '' }}" type="text" name="hour" id="hour" value="{{ old('hour', $employment->hour) }}" required>
                @if($errors->has('hour'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hour') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employment.fields.hour_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="money">{{ trans('cruds.employment.fields.money') }}</label>
                <input class="form-control integer {{ $errors->has('money') ? 'is-invalid' : '' }}" type="text" name="money" id="money" value="{{ old('money', $employment->money) }}" required>
                @if($errors->has('money'))
                    <div class="invalid-feedback">
                        {{ $errors->first('money') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employment.fields.money_helper') }}</span>
            </div>
            
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection