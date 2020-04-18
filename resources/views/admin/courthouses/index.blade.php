@extends('layouts.admin')
@section('content')
@can('courthouse_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.courthouses.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.courthouse.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.courthouse.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Courthouse">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.courthouse.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.courthouse.fields.courthouse_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.courthouse.fields.courthouse_street') }}
                        </th>
                        <th>
                            {{ trans('cruds.courthouse.fields.courthouse_city') }}
                        </th>
                        <th>
                            {{ trans('cruds.courthouse.fields.courthouse_state') }}
                        </th>
                        <th>
                            {{ trans('cruds.courthouse.fields.courthouse_zip') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courthouses as $key => $courthouse)
                        <tr data-entry-id="{{ $courthouse->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $courthouse->id ?? '' }}
                            </td>
                            <td>
                                {{ $courthouse->courthouse_name ?? '' }}
                            </td>
                            <td>
                                {{ $courthouse->courthouse_street ?? '' }}
                            </td>
                            <td>
                                {{ $courthouse->courthouse_city ?? '' }}
                            </td>
                            <td>
                                {{ $courthouse->courthouse_state ?? '' }}
                            </td>
                            <td>
                                {{ $courthouse->courthouse_zip ?? '' }}
                            </td>
                            <td>
                                @can('courthouse_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.courthouses.show', $courthouse->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('courthouse_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.courthouses.edit', $courthouse->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('courthouse_delete')
                                    <form action="{{ route('admin.courthouses.destroy', $courthouse->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('courthouse_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.courthouses.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Courthouse:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection