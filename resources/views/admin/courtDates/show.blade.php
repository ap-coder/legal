@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.courtDate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.court-dates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.courtDate.fields.id') }}
                        </th>
                        <td>
                            {{ $courtDate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtDate.fields.client') }}
                        </th>
                        <td>
                            {{ $courtDate->client->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtDate.fields.court_case') }}
                        </th>
                        <td>
                            @foreach($courtDate->court_cases as $key => $court_case)
                                <span class="label label-info">{{ $court_case->case_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtDate.fields.courthouse') }}
                        </th>
                        <td>
                            {{ $courtDate->courthouse->courthouse_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtDate.fields.docket_number') }}
                        </th>
                        <td>
                            {{ $courtDate->docket_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtDate.fields.courtdate') }}
                        </th>
                        <td>
                            {{ $courtDate->courtdate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtDate.fields.needed') }}
                        </th>
                        <td>
                            {!! $courtDate->needed !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtDate.fields.outcome') }}
                        </th>
                        <td>
                            {!! $courtDate->outcome !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.court-dates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#court_dates_accounts" role="tab" data-toggle="tab">
                {{ trans('cruds.account.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="court_dates_accounts">
            @includeIf('admin.courtDates.relationships.courtDatesAccounts', ['accounts' => $courtDate->courtDatesAccounts])
        </div>
    </div>
</div>

@endsection