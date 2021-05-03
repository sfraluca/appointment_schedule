@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} Tip de muncă
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="employee_id">Angajat</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $employee)
                        <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $employee }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employee') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="hour">Ore</label>
                <input class="form-control integer {{ $errors->has('hour') ? 'is-invalid' : '' }}" type="text" name="hour" id="hour" value="{{ old('hour') }}" required>
                @if($errors->has('hour'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hour') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="money">Salar</label>
                <input class="form-control integer {{ $errors->has('money') ? 'is-invalid' : '' }}" type="text" name="money" id="money" value="{{ old('money') }}" required>
                @if($errors->has('money'))
                    <div class="invalid-feedback">
                        {{ $errors->first('money') }}
                    </div>
                @endif
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