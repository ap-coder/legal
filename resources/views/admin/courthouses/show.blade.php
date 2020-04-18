@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.courthouse.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courthouses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.courthouse.fields.id') }}
                        </th>
                        <td>
                            {{ $courthouse->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courthouse.fields.courthouse_name') }}
                        </th>
                        <td>
                            {{ $courthouse->courthouse_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courthouse.fields.courthouse_street') }}
                        </th>
                        <td>
                            {{ $courthouse->courthouse_street }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courthouse.fields.courthouse_street_2') }}
                        </th>
                        <td>
                            {{ $courthouse->courthouse_street_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courthouse.fields.courthouse_city') }}
                        </th>
                        <td>
                            {{ $courthouse->courthouse_city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courthouse.fields.courthouse_state') }}
                        </th>
                        <td>
                            {{ $courthouse->courthouse_state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courthouse.fields.courthouse_zip') }}
                        </th>
                        <td>
                            {{ $courthouse->courthouse_zip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courthouse.fields.googlemaps_url') }}
                        </th>
                        <td>
                            {{ $courthouse->googlemaps_url }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courthouses.index') }}">
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
            <a class="nav-link" href="#courthouse_accounts" role="tab" data-toggle="tab">
                {{ trans('cruds.account.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="courthouse_accounts">
            @includeIf('admin.courthouses.relationships.courthouseAccounts', ['accounts' => $courthouse->courthouseAccounts])
        </div>
    </div>
</div>

@endsection