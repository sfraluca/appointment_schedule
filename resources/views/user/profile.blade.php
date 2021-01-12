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
<div class="card">

   <div class="card-body">
    @foreach($employees as $key => $employee) 
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">{{$employee->first_name . ' ' . $employee->last_name}}</h4>
        <h6 class="card-subtitle mb-2 text-muted"> {{ trans('cruds.employee.id') }}:{{ $employee->id ?? '' }}</h6>
        <p class="card-text">{{ trans('cruds.employee.phone') }}:{{ $employee->phone ?? '' }}</p> 
        <p class="card-text">{{ trans('cruds.employee.email') }}:{{ $employee->email ?? '' }}</p>
        <p class="card-text">{{ trans('cruds.employee.hour') }}:{{ $employee->hour ?? '' }}</p> 
        <p class="card-text">{{ trans('cruds.employee.money') }}:{{ $employee->money ?? '' }}</p>

    </div>
    </div>  
    </div>                   
    @endforeach
    </div>
</div>
<div class="card" style="margin-bottom: 10px;">

   <div class="card-body">
<div class="row">

            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-2"> @lang('current_year')
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
                <div class="card-body">
                  <h4 class="font-weight-normal mb-2"> @lang('last_year')
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
    <div class="card-body">
      <h4 class="font-weight-normal mb-2"> @lang('current_month')
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
    <div class="card-body">
      <h4 class="font-weight-normal mb-2"> @lang('last_month')
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

@endsection