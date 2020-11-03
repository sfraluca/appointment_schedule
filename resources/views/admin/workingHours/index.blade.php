@extends('layouts.admin')
@section('content')
@can('working_hour_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.working-hours.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.workingHour.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.workingHour.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-WorkingHour">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.workingHour.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.workingHour.fields.employee') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.workingHour.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.workingHour.fields.start_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.workingHour.fields.finish_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.workingHour.fields.project') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('working_hour_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.working-hours.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.working-hours.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'employee_first_name', name: 'employee.first_name' },
{ data: 'employee.last_name', name: 'employee.last_name' },
{ data: 'date', name: 'date' },
{ data: 'start_time', name: 'start_time' },
{ data: 'finish_time', name: 'finish_time' },
{ data: 'project_name', name: 'project.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-WorkingHour').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection