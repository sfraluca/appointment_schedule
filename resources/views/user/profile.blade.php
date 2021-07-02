@extends('layouts.admin')
@section('content')
@can('employment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.employments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.employments.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card" style="margin-bottom: 10px;">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  @foreach($employees as $key => $employee) 
  {{$employee->first_name . ' ' . $employee->last_name}}
  @endforeach
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profilul tău</h5>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      @foreach($employees as $key => $employee) 
        <p class="card-text"><i class="fas fa-phone"></i> {{ $employee->phone ?? '' }}</p> 
        <p class="card-text"><i class="fas fa-envelope"></i> {{ $employee->email ?? '' }}</p>
        <p class="card-text"><i class="fas fa-clock"></i> {{ $employee->hour ?? '' }}</p> 
        <p class="card-text"><i class="fas fa-money"></i> {{ $employee->money ?? '' }}</p>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="card">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user_create') }}">
                {{ trans('global.add') }} {{ trans('cruds.workingHour.title_singular') }}
            </a>
        </div>
    </div>

<div id="calendar"></div>

</div>

<div class="card" style="margin-bottom: 10px;">

   <div class="card-body">
<div class="row">

            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white" >
                <div class="card-body" style="background-image: linear-gradient(to right, #e590b5, #faab9f)" >
                  <h4 class="font-weight-normal mb-2">Anul curent
                    <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"> @foreach($report_cy as $month =>$value_cy)
                               <p> {{ $value_cy['hours']}}</p>
                            @endforeach</h2>
                </div>
              </div>
            </div>
            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body" style="background-image: linear-gradient(to right, #6fa1ac, #59bac0)" >
                  <h4 class="font-weight-normal mb-2"> Anul trecut
                    <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"> @foreach($report_ly as $month =>$value_ly)
                               <p> {{ $value_ly['hours']}}</p>
                            @endforeach</h2>
                </div>
              </div>
            </div>
        </div>

            <div class="row">

<div class="col-md-6 stretch-card grid-margin">
  <div class="card bg-gradient-danger card-img-holder text-white">
    <div class="card-body" style="background-color: #e590b5;" >
      <h4 class="font-weight-normal mb-2">Luna curentă
        <i class="mdi mdi-chart-line mdi-24px float-right"></i>
      </h4>
      <h2 class="mb-5"> @foreach($report_cm as $month =>$value_cm)
                   <p> {{ $value_cm['hours']}}</p>
                @endforeach</h2>
    </div>
  </div>
</div>
<div class="col-md-6 stretch-card grid-margin">
  <div class="card bg-gradient-danger card-img-holder text-white">
    <div class="card-body" style="background-color: #b48484;" >
      <h4 class="font-weight-normal mb-2"> Luna trecută
        <i class="mdi mdi-chart-line mdi-24px float-right"></i>
      </h4>
      <h2 class="mb-5"> @foreach($report_lm as $month =>$value_lm)
                   <p> {{ $value_lm['hours']}}</p>
                @endforeach</h2>
    </div>
  </div>
</div>
</div>
</div>
</div>
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
                    // url : "{{ route('admin.user_edit', $hour->id) }}"
                },
                @endforeach
            ]


            })
        });
      </script>
@endsection