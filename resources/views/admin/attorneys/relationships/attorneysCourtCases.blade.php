<div class="m-3">
    @can('court_case_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.court-cases.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.courtCase.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.courtCase.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-attorneysCourtCases">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.courtCase.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.courtCase.fields.client') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.last_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.courtCase.fields.case_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.courtCase.fields.case_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.courtCase.fields.attorneys') }}
                            </th>
                            <th>
                                {{ trans('cruds.courtCase.fields.employees') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courtCases as $key => $courtCase)
                            <tr data-entry-id="{{ $courtCase->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $courtCase->id ?? '' }}
                                </td>
                                <td>
                                    {{ $courtCase->client->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $courtCase->client->last_name ?? '' }}
                                </td>
                                <td>
                                    {{ $courtCase->case_name ?? '' }}
                                </td>
                                <td>
                                    {{ $courtCase->case_number ?? '' }}
                                </td>
                                <td>
                                    @foreach($courtCase->attorneys as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($courtCase->employees as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('court_case_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.court-cases.show', $courtCase->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('court_case_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.court-cases.edit', $courtCase->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('court_case_delete')
                                        <form action="{{ route('admin.court-cases.destroy', $courtCase->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('court_case_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.court-cases.massDestroy') }}",
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
  $('.datatable-attorneysCourtCases:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection