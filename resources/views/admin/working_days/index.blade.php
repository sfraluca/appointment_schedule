@extends('layouts.admin')
@section('content')
@can('client_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.working_days.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.client.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.working_days.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-WorkingDays">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        ID
                    </th>
                    <th>
                        Lună
                    </th>
                    <th>
                        Zile
                    </th>
                    <th>
                        Angajați
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                    @foreach($working_days as $key => $working_day)
                        <tr data-entry-id="{{ $working_day->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $working_day->id ?? '' }}
                            </td>
                            <td>
                                {{ $working_day->month ?? '' }}
                            </td>
                            <td>
                                {{ $working_day->days ?? '' }}
                            </td>
                            <td>
                                {{ $working_day->first_name ?? '' }}  {{ $working_day->last_name ?? '' }}
                            </td>
                            <td>
                                @can('working_day_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.working_days.show', $working_day->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('working_day_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.working_days.edit', $working_day->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('working_day_delete')
                                    <form action="{{ route('admin.working_days.destroy', $working_day->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('working_days_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.working_days.massDestroy') }}",
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
    ajax: "{{ route('admin.working_days.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'days', name: 'days' },
{ data: 'month', name: 'month' },
{ data: 'employee', name: 'employee' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-WorkingsDays').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection