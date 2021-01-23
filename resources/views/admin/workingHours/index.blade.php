@extends('layouts.admin')
@section('content')
<div class="btn-group" role="group" aria-label="Basic example">
@can('working_hour_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.working-hours.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.workingHour.title_singular') }}
            </a>
        </div>
    </div>
@endcan
@can('raport_access')
<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.raport') }}">
                {{ trans('global.raport') }}
            </a>
        </div>
    </div>
@endcan
</div>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

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

<h3 class="page-title"> {{ trans('global.calendar') }}</h3>
<div id="calendar"></div>

@endsection
@section('scripts')
@parent
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
$(document).ready(function () {
            // page is now ready, initialize the calendar...
           
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                defaultView: 'agendaWeek',
                events: [
                @foreach( $working_hours as $hour)
                {
                    title : '{{ $hour->employee->first_name . '' . $hour->employee->last_name}}',
                    start : '{{ $hour->date . ' ' . $hour->start_time }}',
                    end : '{{ $hour->date . ' ' . $hour->finish_time}}',
                    url : "{{ route('admin.working-hours.edit', $hour->id) }}"
                },
                @endforeach
            ]


            })
        });
      </script>
@endsection