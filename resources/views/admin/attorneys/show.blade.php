@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.attorney.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attorneys.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.id') }}
                        </th>
                        <td>
                            {{ $attorney->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.status') }}
                        </th>
                        <td>
                            {{ App\Attorney::STATUS_SELECT[$attorney->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.title') }}
                        </th>
                        <td>
                            {{ $attorney->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.name') }}
                        </th>
                        <td>
                            {{ $attorney->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.specialty') }}
                        </th>
                        <td>
                            {{ $attorney->specialty }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.phone') }}
                        </th>
                        <td>
                            {{ $attorney->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.email') }}
                        </th>
                        <td>
                            {{ $attorney->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.intro') }}
                        </th>
                        <td>
                            {{ $attorney->intro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.content_area') }}
                        </th>
                        <td>
                            {!! $attorney->content_area !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.content_area_2') }}
                        </th>
                        <td>
                            {!! $attorney->content_area_2 !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.notes') }}
                        </th>
                        <td>
                            {{ $attorney->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.photo') }}
                        </th>
                        <td>
                            @if($attorney->photo)
                                <a href="{{ $attorney->photo->getUrl() }}" target="_blank">
                                    <img src="{{ $attorney->photo->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.bio_area') }}
                        </th>
                        <td>
                            {!! $attorney->bio_area !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.banner') }}
                        </th>
                        <td>
                            @if($attorney->banner)
                                <a href="{{ $attorney->banner->getUrl() }}" target="_blank">
                                    <img src="{{ $attorney->banner->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.facebook') }}
                        </th>
                        <td>
                            {{ $attorney->facebook }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.twitter') }}
                        </th>
                        <td>
                            {{ $attorney->twitter }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.google') }}
                        </th>
                        <td>
                            {{ $attorney->google }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.youtube') }}
                        </th>
                        <td>
                            {{ $attorney->youtube }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.linkedin') }}
                        </th>
                        <td>
                            {{ $attorney->linkedin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attorney.fields.other_link') }}
                        </th>
                        <td>
                            {{ $attorney->other_link }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attorneys.index') }}">
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
            <a class="nav-link" href="#attorneys_court_cases" role="tab" data-toggle="tab">
                {{ trans('cruds.courtCase.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="attorneys_court_cases">
            @includeIf('admin.attorneys.relationships.attorneysCourtCases', ['courtCases' => $attorney->attorneysCourtCases])
        </div>
    </div>
</div>

@endsection