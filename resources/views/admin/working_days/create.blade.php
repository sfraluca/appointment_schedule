@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} Zile de lucru
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.working_days.store") }}" enctype="multipart/form-data">
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
                <label class="required" for="days">Zile de lucru</label>
                <input class="form-control integer {{ $errors->has('days') ? 'is-invalid' : '' }}" type="text" name="days" id="days" value="{{ old('days') }}" required>
                @if($errors->has('days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('days') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="month">Luna</label>
                <select id="month" name="month">
                <option selected>Ianuarie</option>
                    <option>Februarie</option>
                    <option>Martie</option>
                    <option>Aprilie</option>
                    <option>Mai</option>
                    <option>Iunie</option>
                    <option>Iulie</option>
                    <option>August</option>
                    <option>Septembrie</option>
                    <option>Octombrie</option>
                    <option>Noiembrie</option>
                    <option>Decembrie</option>
                    </select>
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