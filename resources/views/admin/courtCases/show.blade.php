@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.courtCase.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.court-cases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.courtCase.fields.id') }}
                        </th>
                        <td>
                            {{ $courtCase->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtCase.fields.client') }}
                        </th>
                        <td>
                            {{ $courtCase->client->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtCase.fields.case_name') }}
                        </th>
                        <td>
                            {{ $courtCase->case_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtCase.fields.case_number') }}
                        </th>
                        <td>
                            {{ $courtCase->case_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtCase.fields.awarded_value') }}
                        </th>
                        <td>
                            {{ $courtCase->awarded_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtCase.fields.proposed_value') }}
                        </th>
                        <td>
                            {{ $courtCase->proposed_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtCase.fields.closed_date') }}
                        </th>
                        <td>
                            {{ $courtCase->closed_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtCase.fields.completed_date') }}
                        </th>
                        <td>
                            {{ $courtCase->completed_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtCase.fields.attorneys') }}
                        </th>
                        <td>
                            @foreach($courtCase->attorneys as $key => $attorneys)
                                <span class="label label-info">{{ $attorneys->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courtCase.fields.employees') }}
                        </th>
                        <td>
                            @foreach($courtCase->employees as $key => $employees)
                                <span class="label label-info">{{ $employees->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.court-cases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection