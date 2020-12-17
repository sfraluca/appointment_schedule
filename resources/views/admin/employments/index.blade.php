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
    <div class="card-header">
        {{ trans('cruds.employments.title_singular') }} {{ trans('global.list') }}
    </div>

   <div class="card-body">
    @foreach($employments as $key => $employment) 
    <div class="card-group">
    <div class="card text-center" style="width: 20rem;">
    <div class="card-body">
        <h4 class="card-title">{{$employment->employee->first_name . ' ' . $employment->employee->last_name}}</h4>
        <h6 class="card-subtitle mb-2 text-muted"> {{ trans('cruds.employee.id') }}:{{ $employment->id ?? '' }}</h6>
        <p class="card-text">{{ trans('cruds.employee.hour') }}:{{ $employment->hour ?? '' }}</p> 
        <p class="card-text">{{ trans('cruds.employee.money') }}:{{ $employment->money ?? '' }}</p>
        @can('employment_show')
        <a href="{{ route('admin.employments.show', $employment->id) }}" class="btn btn-primary"> {{ trans('global.view') }}</a>
        @endcan
        @can('employment_edit')
        <a href="{{ route('admin.employments.edit', $employment->id) }}" class="btn btn-info">{{ trans('global.edit') }}</a>
        @endcan
        @can('employment_delete')
            <form action="{{ route('admin.employments.destroy', $employment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-danger" value="{{ trans('global.delete') }}">
            </form>
        @endcan

    </div>
    </div>  
    </div>                   
    @endforeach
    </div>
</div>



@endsection
@section('scripts')
@parent

@endsection