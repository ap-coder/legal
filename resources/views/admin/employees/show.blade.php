@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.employee.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.id') }}
                        </th>
                        <td>
                            {{ $employee->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.status') }}
                        </th>
                        <td>
                            {{ App\Employee::STATUS_SELECT[$employee->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.title') }}
                        </th>
                        <td>
                            {{ $employee->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.name') }}
                        </th>
                        <td>
                            {{ $employee->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.phone') }}
                        </th>
                        <td>
                            {{ $employee->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.email') }}
                        </th>
                        <td>
                            {{ $employee->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.photo') }}
                        </th>
                        <td>
                            @if($employee->photo)
                                <a href="{{ $employee->photo->getUrl() }}" target="_blank">
                                    <img src="{{ $employee->photo->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.type') }}
                        </th>
                        <td>
                            {{ $employee->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.intro') }}
                        </th>
                        <td>
                            {{ $employee->intro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.bio_area') }}
                        </th>
                        <td>
                            {!! $employee->bio_area !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.content_area') }}
                        </th>
                        <td>
                            {!! $employee->content_area !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.content_area_2') }}
                        </th>
                        <td>
                            {!! $employee->content_area_2 !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.banner') }}
                        </th>
                        <td>
                            @if($employee->banner)
                                <a href="{{ $employee->banner->getUrl() }}" target="_blank">
                                    <img src="{{ $employee->banner->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.facebook') }}
                        </th>
                        <td>
                            {{ $employee->facebook }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.twitter') }}
                        </th>
                        <td>
                            {{ $employee->twitter }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.google') }}
                        </th>
                        <td>
                            {{ $employee->google }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.youtube') }}
                        </th>
                        <td>
                            {{ $employee->youtube }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.linkedin') }}
                        </th>
                        <td>
                            {{ $employee->linkedin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.other_link') }}
                        </th>
                        <td>
                            {{ $employee->other_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.notes') }}
                        </th>
                        <td>
                            {{ $employee->notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employees.index') }}">
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
            <a class="nav-link" href="#employees_court_cases" role="tab" data-toggle="tab">
                {{ trans('cruds.courtCase.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="employees_court_cases">
            @includeIf('admin.employees.relationships.employeesCourtCases', ['courtCases' => $employee->employeesCourtCases])
        </div>
    </div>
</div>

@endsection