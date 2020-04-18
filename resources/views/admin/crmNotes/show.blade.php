@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.crmNote.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-notes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.crmNote.fields.id') }}
                        </th>
                        <td>
                            {{ $crmNote->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmNote.fields.note') }}
                        </th>
                        <td>
                            {{ $crmNote->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmNote.fields.customer') }}
                        </th>
                        <td>
                            {{ $crmNote->customer->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmNote.fields.court_case') }}
                        </th>
                        <td>
                            {{ $crmNote->court_case->case_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-notes.index') }}">
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
            <a class="nav-link" href="#notes_accounts" role="tab" data-toggle="tab">
                {{ trans('cruds.account.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="notes_accounts">
            @includeIf('admin.crmNotes.relationships.notesAccounts', ['accounts' => $crmNote->notesAccounts])
        </div>
    </div>
</div>

@endsection