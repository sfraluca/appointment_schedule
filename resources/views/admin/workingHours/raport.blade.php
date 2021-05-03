@extends('layouts.admin')
@section('content')
<div class='row'>
<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-secondary" href="{{ route('admin.working-hours.index') }}">
                {{ trans('global.back') }}
            </a>
        </div>
    </div>
    @can('working_hour_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.working-hours.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.workingHour.title_singular') }}
            </a>
        </div>
    </div>
@endcan

</div>

  <h3 class="page-title">Raport</h3>
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
  <div class="card">
    <div class="card-header">
        {{ trans('cruds.project.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Project">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>Lună</th>
                        <th>Ore</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($report_cm as $month =>$value_cm)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_cm['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                @foreach($report_lm as $month =>$value_lm)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_lm['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                @foreach($report_l2m as $month =>$value_l2m)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_l2m['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                @foreach($report_l3m as $month =>$value_l3m)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_l3m['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                @foreach($report_l4m as $month =>$value_l4m)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_l4m['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                @foreach($report_l5m as $month =>$value_l5m)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_l5m['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                @foreach($report_l6m as $month =>$value_l6m)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_l6m['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                @foreach($report_l7m as $month =>$value_l7m)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_l7m['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                @foreach($report_l8m as $month =>$value_l8m)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_l8m['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                @foreach($report_l9m as $month =>$value_l9m)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_l9m['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                @foreach($report_l10m as $month =>$value_l10m)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_l10m['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                @foreach($report_l11m as $month =>$value_l11m)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_l11m['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                @foreach($report_l12m as $month =>$value_l12m)
                <tr><td></td><td>{{ \Carbon\Carbon::parse($month)->format('F Y')}}</td>
                    <td>{{ $value_l12m['hours']}}</td>
                    <td><a class="btn btn-xs btn-primary" href="">{{ trans('global.view') }}</a>
                        <a class="btn btn-xs btn-info" href="">{{ trans('global.edit') }}</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
           

            </div> 
            <div class="row">

            <div class="col-md-6 stretch-card grid-margin" >
              <div class="card card-img-holder text-white" style="background-image: linear-gradient(to right, #e590b5, #faab9f)" >
                <div class="card-body">
                  <h4 class="font-weight-normal mb-2"> Anul curent
                    <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"> @foreach($report_cy as $month =>$value_cy)
                               <p> {{ $value_cy['hours']}}</p>
                            @endforeach</h2>
                </div>
              </div>
            </div>
            <div class="col-md-6 stretch-card grid-margin">
              <div class="card card-img-holder text-white" style="background-image: linear-gradient(to right, #6fa1ac, #59bac0)">
                <div class="card-body">
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
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('project_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.projects.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Project:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection