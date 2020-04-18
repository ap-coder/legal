@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.post.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.posts.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('cruds.post.fields.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($post) ? $post->title : '') }}" required>
                @if($errors->has('title'))
                    <p class="help-block">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.post.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('categories') ? 'has-error' : '' }}">
                <label for="category">{{ trans('cruds.post.fields.category') }}
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="categories[]" id="categories" class="form-control select2" multiple="multiple">
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || isset($post) && $post->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <p class="help-block">
                        {{ $errors->first('categories') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.post.fields.category_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                <label for="tag">{{ trans('cruds.post.fields.tag') }}
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="tags[]" id="tags" class="form-control select2" multiple="multiple">
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || isset($post) && $post->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <p class="help-block">
                        {{ $errors->first('tags') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.post.fields.tag_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('post_text') ? 'has-error' : '' }}">
                <label for="post_text">{{ trans('cruds.post.fields.post_text') }}</label>
                <textarea id="post_text" name="post_text" class="form-control ckeditor">{{ old('post_text', isset($post) ? $post->post_text : '') }}</textarea>
                @if($errors->has('post_text'))
                    <p class="help-block">
                        {{ $errors->first('post_text') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.post.fields.post_text_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                <label for="excerpt">{{ trans('cruds.post.fields.excerpt') }}</label>
                <textarea id="excerpt" name="excerpt" class="form-control ">{{ old('excerpt', isset($post) ? $post->excerpt : '') }}</textarea>
                @if($errors->has('excerpt'))
                    <p class="help-block">
                        {{ $errors->first('excerpt') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.post.fields.excerpt_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('featured_image') ? 'has-error' : '' }}">
                <label for="featured_image">{{ trans('cruds.post.fields.featured_image') }}</label>
                <div class="needsclick dropzone" id="featured_image-dropzone">

                </div>
                @if($errors->has('featured_image'))
                    <p class="help-block">
                        {{ $errors->first('featured_image') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.post.fields.featured_image_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('meta_title') ? 'has-error' : '' }}">
                <label for="meta_title">{{ trans('cruds.post.fields.meta_title') }}</label>
                <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ old('meta_title', isset($post) ? $post->meta_title : '') }}">
                @if($errors->has('meta_title'))
                    <p class="help-block">
                        {{ $errors->first('meta_title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.post.fields.meta_title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('meta_description') ? 'has-error' : '' }}">
                <label for="meta_description">{{ trans('cruds.post.fields.meta_description') }}</label>
                <input type="text" id="meta_description" name="meta_description" class="form-control" value="{{ old('meta_description', isset($post) ? $post->meta_description : '') }}">
                @if($errors->has('meta_description'))
                    <p class="help-block">
                        {{ $errors->first('meta_description') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.post.fields.meta_description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('facebook_title') ? 'has-error' : '' }}">
                <label for="facebook_title">{{ trans('cruds.post.fields.facebook_title') }}</label>
                <input type="text" id="facebook_title" name="facebook_title" class="form-control" value="{{ old('facebook_title', isset($post) ? $post->facebook_title : '') }}">
                @if($errors->has('facebook_title'))
                    <p class="help-block">
                        {{ $errors->first('facebook_title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.post.fields.facebook_title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('facebook_desc') ? 'has-error' : '' }}">
                <label for="facebook_desc">{{ trans('cruds.post.fields.facebook_desc') }}</label>
                <input type="text" id="facebook_desc" name="facebook_desc" class="form-control" value="{{ old('facebook_desc', isset($post) ? $post->facebook_desc : '') }}">
                @if($errors->has('facebook_desc'))
                    <p class="help-block">
                        {{ $errors->first('facebook_desc') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.post.fields.facebook_desc_helper') }}
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
    url: '{{ route('admin.posts.storeMedia') }}',
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
@if(isset($post) && $post->featured_image)
      var file = {!! json_encode($post->featured_image) !!}
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
@stop