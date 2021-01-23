@extends('layouts.admin')
@section('content')


<h3 class="page-title">Payment</h3>

<form action="" method="GET">
    <div class="row">
        <div class="col-xs-6 col-md-4 form-group">
            <label class="control-label" for="employee">{{ trans('cruds.workingHour.fields.employee') }}</label>
            <select id="employee" name="employee" class="form-control">
                @foreach($employees as $key => $value)
                <option value="{{ $key }}" @if ($key==$currentEmployee) selected @endif>{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-4">
            <label class="control-label">&nbsp;</label><br>
            <input class="btn btn-primary" type="submit" value="{{ trans('global.submit') }}">
        </div>
    </div>
</form>




<!-- <p>Angajatul a lucrat 
    @foreach($report_lm as $month =>$value_lm)
    pe luna {{ \Carbon\Carbon::parse($month)->format('F')}} : {{ $value_lm['hours']}}
    @endforeach

din  <span>{{$month_hours}}</span>h</p>
<p>Salariul este de: {{$salary}} lei</p> -->

<div>
<form method="POST" action="{{ url('admin/salary_save')}}">
            @csrf
            <div class="form-group">
                <label for="employee">Angajatul:</label>
                <input class="form-control {{ $errors->has('employee_id') ? 'is-invalid' : '' }}" type="text" name="employee_id" id="employee_id" value="{{ $key }}" @if ($key==$currentEmployee) selected @endif>
                <input class="form-control {{ $errors->has('employee') ? 'is-invalid' : '' }}" type="text" name="employee" id="employee" value="{{ $value }}" @if ($key==$currentEmployee)  @endif>
              
                @if($errors->has('employee'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employee') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="month">Luna:</label>
                @foreach($report_lm as $month =>$value_lm)
            <input class="form-control {{ $errors->has('month') ? 'is-invalid' : '' }}" type="text" name="month" id="month" value=" {{ \Carbon\Carbon::parse($month)->format('F')}}">
              @endforeach
                @if($errors->has('month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('month') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="hours">Ore/<span>{{$month_hours}}</span>h</label>
                @foreach($report_lm as $month =>$value_lm)
                <input class="form-control {{ $errors->has('hours') ? 'is-invalid' : '' }}" type="text" name="hours" id="hours" value="{{  $value_lm['hours'] }}" >
                @endforeach
                @if($errors->has('hours'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hours') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="salary">Salariul:</label>
                <input class="form-control {{ $errors->has('salary') ? 'is-invalid' : '' }}" type="text" name="salary" id="salary" value="{{ $salary }}">
              
                @if($errors->has('salary'))
                    <div class="invalid-feedback">
                        {{ $errors->first('salary') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                   Save(opțional)
                </button>
            </div>
        </form>
</div>


@endsection