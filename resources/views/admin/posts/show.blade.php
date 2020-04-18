@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.post.title') }}
    </div>

    <div class="card-body">
        <div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.post.fields.id') }}
                        </th>
                        <td>
                            {{ $post->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.post.fields.title') }}
                        </th>
                        <td>
                            {{ $post->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Categories
                        </th>
                        <td>
                            @foreach($post->categories as $id => $category)
                                <span class="label label-info label-many">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tags
                        </th>
                        <td>
                            @foreach($post->tags as $id => $tag)
                                <span class="label label-info label-many">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.post.fields.post_text') }}
                        </th>
                        <td>
                            {!! $post->post_text !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.post.fields.excerpt') }}
                        </th>
                        <td>
                            {!! $post->excerpt !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.post.fields.featured_image') }}
                        </th>
                        <td>
                            @if($post->featured_image)
                                <a href="{{ $post->featured_image->getUrl() }}" target="_blank">
                                    <img src="{{ $post->featured_image->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.post.fields.meta_title') }}
                        </th>
                        <td>
                            {{ $post->meta_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.post.fields.meta_description') }}
                        </th>
                        <td>
                            {{ $post->meta_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.post.fields.facebook_title') }}
                        </th>
                        <td>
                            {{ $post->facebook_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.post.fields.facebook_desc') }}
                        </th>
                        <td>
                            {{ $post->facebook_desc }}
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