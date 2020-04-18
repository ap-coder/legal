@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.service.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.services.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('cruds.service.fields.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($service) ? $service->title : '') }}" required>
                @if($errors->has('title'))
                    <p class="help-block">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('categories') ? 'has-error' : '' }}">
                <label for="category">{{ trans('cruds.service.fields.category') }}
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="categories[]" id="categories" class="form-control select2" multiple="multiple">
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || isset($service) && $service->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <p class="help-block">
                        {{ $errors->first('categories') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.category_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                <label for="tag">{{ trans('cruds.service.fields.tag') }}
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="tags[]" id="tags" class="form-control select2" multiple="multiple">
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || isset($service) && $service->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <p class="help-block">
                        {{ $errors->first('tags') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.tag_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('service_text') ? 'has-error' : '' }}">
                <label for="service_text">{{ trans('cruds.service.fields.service_text') }}</label>
                <textarea id="service_text" name="service_text" class="form-control ckeditor">{{ old('service_text', isset($service) ? $service->service_text : '') }}</textarea>
                @if($errors->has('service_text'))
                    <p class="help-block">
                        {{ $errors->first('service_text') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.service_text_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('service_text_2') ? 'has-error' : '' }}">
                <label for="service_text_2">{{ trans('cruds.service.fields.service_text_2') }}</label>
                <textarea id="service_text_2" name="service_text_2" class="form-control ckeditor">{{ old('service_text_2', isset($service) ? $service->service_text_2 : '') }}</textarea>
                @if($errors->has('service_text_2'))
                    <p class="help-block">
                        {{ $errors->first('service_text_2') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.service_text_2_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                <label for="excerpt">{{ trans('cruds.service.fields.excerpt') }}</label>
                <textarea id="excerpt" name="excerpt" class="form-control ">{{ old('excerpt', isset($service) ? $service->excerpt : '') }}</textarea>
                @if($errors->has('excerpt'))
                    <p class="help-block">
                        {{ $errors->first('excerpt') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.excerpt_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('featured_image') ? 'has-error' : '' }}">
                <label for="featured_image">{{ trans('cruds.service.fields.featured_image') }}</label>
                <div class="needsclick dropzone" id="featured_image-dropzone">

                </div>
                @if($errors->has('featured_image'))
                    <p class="help-block">
                        {{ $errors->first('featured_image') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.featured_image_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('meta_title') ? 'has-error' : '' }}">
                <label for="meta_title">{{ trans('cruds.service.fields.meta_title') }}</label>
                <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ old('meta_title', isset($service) ? $service->meta_title : '') }}">
                @if($errors->has('meta_title'))
                    <p class="help-block">
                        {{ $errors->first('meta_title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.meta_title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('meta_description') ? 'has-error' : '' }}">
                <label for="meta_description">{{ trans('cruds.service.fields.meta_description') }}</label>
                <input type="text" id="meta_description" name="meta_description" class="form-control" value="{{ old('meta_description', isset($service) ? $service->meta_description : '') }}">
                @if($errors->has('meta_description'))
                    <p class="help-block">
                        {{ $errors->first('meta_description') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.meta_description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('facebook_title') ? 'has-error' : '' }}">
                <label for="facebook_title">{{ trans('cruds.service.fields.facebook_title') }}</label>
                <input type="text" id="facebook_title" name="facebook_title" class="form-control" value="{{ old('facebook_title', isset($service) ? $service->facebook_title : '') }}">
                @if($errors->has('facebook_title'))
                    <p class="help-block">
                        {{ $errors->first('facebook_title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.facebook_title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('facebook_desc') ? 'has-error' : '' }}">
                <label for="facebook_desc">{{ trans('cruds.service.fields.facebook_desc') }}</label>
                <input type="text" id="facebook_desc" name="facebook_desc" class="form-control" value="{{ old('facebook_desc', isset($service) ? $service->facebook_desc : '') }}">
                @if($errors->has('facebook_desc'))
                    <p class="help-block">
                        {{ $errors->first('facebook_desc') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.facebook_desc_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('banner') ? 'has-error' : '' }}">
                <label for="banner">{{ trans('cruds.service.fields.banner') }}</label>
                <div class="needsclick dropzone" id="banner-dropzone">

                </div>
                @if($errors->has('banner'))
                    <p class="help-block">
                        {{ $errors->first('banner') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.banner_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('icon_class') ? 'has-error' : '' }}">
                <label for="icon_class">{{ trans('cruds.service.fields.icon_class') }}</label>
                <input type="text" id="icon_class" name="icon_class" class="form-control" value="{{ old('icon_class', isset($service) ? $service->icon_class : 'fa-cog') }}">
                @if($errors->has('icon_class'))
                    <p class="help-block">
                        {{ $errors->first('icon_class') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.service.fields.icon_class_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.featuredImageDropzone = {
    url: '{{ route('admin.services.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4086,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="featured_image"]').remove()
      $('form').append('<input type="hidden" name="featured_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="featured_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($service) && $service->featured_image)
      var file = {!! json_encode($service->featured_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="featured_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    Dropzone.options.bannerDropzone = {
    url: '{{ route('admin.services.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="banner"]').remove()
      $('form').append('<input type="hidden" name="banner" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="banner"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($service) && $service->banner)
      var file = {!! json_encode($service->banner) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="banner" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@stop