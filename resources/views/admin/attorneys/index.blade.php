@extends('layouts.admin')
@section('content')
@can('attorney_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.attorneys.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.attorney.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.attorney.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Attorney">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.attorney.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.attorney.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.attorney.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attorneys as $key => $attorney)
                        <tr data-entry-id="{{ $attorney->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $attorney->id ?? '' }}
                            </td>
                            <td>
                                {{ App\Attorney::STATUS_SELECT[$attorney->status] ?? '' }}
                            </td>
                            <td>
                                {{ $attorney->name ?? '' }}
                            </td>
                            <td>
                                @can('attorney_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.attorneys.show', $attorney->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('attorney_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.attorneys.edit', $attorney->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('attorney_delete')
                                    <form action="{{ route('admin.attorneys.destroy', $attorney->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('attorney_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.attorneys.massDestroy') }}",
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
  $('.datatable-Attorney:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection