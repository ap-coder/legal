@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.service.title') }}
    </div>

    <div class="card-body">
        <div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.id') }}
                        </th>
                        <td>
                            {{ $service->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.title') }}
                        </th>
                        <td>
                            {{ $service->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Categories
                        </th>
                        <td>
                            @foreach($service->categories as $id => $category)
                                <span class="label label-info label-many">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tags
                        </th>
                        <td>
                            @foreach($service->tags as $id => $tag)
                                <span class="label label-info label-many">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.service_text') }}
                        </th>
                        <td>
                            {!! $service->service_text !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.service_text_2') }}
                        </th>
                        <td>
                            {!! $service->service_text_2 !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.excerpt') }}
                        </th>
                        <td>
                            {!! $service->excerpt !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.featured_image') }}
                        </th>
                        <td>
                            @if($service->featured_image)
                                <a href="{{ $service->featured_image->getUrl() }}" target="_blank">
                                    <img src="{{ $service->featured_image->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.meta_title') }}
                        </th>
                        <td>
                            {{ $service->meta_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.meta_description') }}
                        </th>
                        <td>
                            {{ $service->meta_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.facebook_title') }}
                        </th>
                        <td>
                            {{ $service->facebook_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.facebook_desc') }}
                        </th>
                        <td>
                            {{ $service->facebook_desc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.banner') }}
                        </th>
                        <td>
                            @if($service->banner)
                                <a href="{{ $service->banner->getUrl() }}" target="_blank">
                                    <img src="{{ $service->banner->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.icon_class') }}
                        </th>
                        <td>
                            {{ $service->icon_class }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection