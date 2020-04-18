<div class="m-3">
    @can('court_date_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.court-dates.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.courtDate.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.courtDate.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-clientCourtDates">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.courtDate.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.courtDate.fields.client') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.last_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.courtDate.fields.court_case') }}
                            </th>
                            <th>
                                {{ trans('cruds.courtDate.fields.courthouse') }}
                            </th>
                            <th>
                                {{ trans('cruds.courtDate.fields.docket_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.courtDate.fields.courtdate') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courtDates as $key => $courtDate)
                            <tr data-entry-id="{{ $courtDate->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $courtDate->id ?? '' }}
                                </td>
                                <td>
                                    {{ $courtDate->client->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $courtDate->client->last_name ?? '' }}
                                </td>
                                <td>
                                    @foreach($courtDate->court_cases as $key => $item)
                                        <span class="badge badge-info">{{ $item->case_name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $courtDate->courthouse->courthouse_name ?? '' }}
                                </td>
                                <td>
                                    {{ $courtDate->docket_number ?? '' }}
                                </td>
                                <td>
                                    {{ $courtDate->courtdate ?? '' }}
                                </td>
                                <td>
                                    @can('court_date_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.court-dates.show', $courtDate->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('court_date_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.court-dates.edit', $courtDate->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('court_date_delete')
                                        <form action="{{ route('admin.court-dates.destroy', $courtDate->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('court_date_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.court-dates.massDestroy') }}",
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
  $('.datatable-clientCourtDates:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection