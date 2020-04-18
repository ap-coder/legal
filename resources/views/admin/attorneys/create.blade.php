@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.attorney.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.attorneys.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.attorney.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Attorney::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title">{{ trans('cruds.attorney.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.attorney.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="specialty">{{ trans('cruds.attorney.fields.specialty') }}</label>
                <input class="form-control {{ $errors->has('specialty') ? 'is-invalid' : '' }}" type="text" name="specialty" id="specialty" value="{{ old('specialty', '') }}">
                @if($errors->has('specialty'))
                    <span class="text-danger">{{ $errors->first('specialty') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.specialty_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.attorney.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.attorney.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="intro">{{ trans('cruds.attorney.fields.intro') }}</label>
                <input class="form-control {{ $errors->has('intro') ? 'is-invalid' : '' }}" type="text" name="intro" id="intro" value="{{ old('intro', '') }}">
                @if($errors->has('intro'))
                    <span class="text-danger">{{ $errors->first('intro') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.intro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="content_area">{{ trans('cruds.attorney.fields.content_area') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('content_area') ? 'is-invalid' : '' }}" name="content_area" id="content_area">{!! old('content_area') !!}</textarea>
                @if($errors->has('content_area'))
                    <span class="text-danger">{{ $errors->first('content_area') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.content_area_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="content_area_2">{{ trans('cruds.attorney.fields.content_area_2') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('content_area_2') ? 'is-invalid' : '' }}" name="content_area_2" id="content_area_2">{!! old('content_area_2') !!}</textarea>
                @if($errors->has('content_area_2'))
                    <span class="text-danger">{{ $errors->first('content_area_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.content_area_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.attorney.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes') }}</textarea>
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.attorney.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bio_area">{{ trans('cruds.attorney.fields.bio_area') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('bio_area') ? 'is-invalid' : '' }}" name="bio_area" id="bio_area">{!! old('bio_area') !!}</textarea>
                @if($errors->has('bio_area'))
                    <span class="text-danger">{{ $errors->first('bio_area') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.bio_area_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="banner">{{ trans('cruds.attorney.fields.banner') }}</label>
                <div class="needsclick dropzone {{ $errors->has('banner') ? 'is-invalid' : '' }}" id="banner-dropzone">
                </div>
                @if($errors->has('banner'))
                    <span class="text-danger">{{ $errors->first('banner') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.banner_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="facebook">{{ trans('cruds.attorney.fields.facebook') }}</label>
                <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text" name="facebook" id="facebook" value="{{ old('facebook', '') }}">
                @if($errors->has('facebook'))
                    <span class="text-danger">{{ $errors->first('facebook') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.facebook_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="twitter">{{ trans('cruds.attorney.fields.twitter') }}</label>
                <input class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}" type="text" name="twitter" id="twitter" value="{{ old('twitter', '') }}">
                @if($errors->has('twitter'))
                    <span class="text-danger">{{ $errors->first('twitter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.twitter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="google">{{ trans('cruds.attorney.fields.google') }}</label>
                <input class="form-control {{ $errors->has('google') ? 'is-invalid' : '' }}" type="text" name="google" id="google" value="{{ old('google', '') }}">
                @if($errors->has('google'))
                    <span class="text-danger">{{ $errors->first('google') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.google_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="youtube">{{ trans('cruds.attorney.fields.youtube') }}</label>
                <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="text" name="youtube" id="youtube" value="{{ old('youtube', '') }}">
                @if($errors->has('youtube'))
                    <span class="text-danger">{{ $errors->first('youtube') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.youtube_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="linkedin">{{ trans('cruds.attorney.fields.linkedin') }}</label>
                <input class="form-control {{ $errors->has('linkedin') ? 'is-invalid' : '' }}" type="text" name="linkedin" id="linkedin" value="{{ old('linkedin', '') }}">
                @if($errors->has('linkedin'))
                    <span class="text-danger">{{ $errors->first('linkedin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.linkedin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="other_link">{{ trans('cruds.attorney.fields.other_link') }}</label>
                <input class="form-control {{ $errors->has('other_link') ? 'is-invalid' : '' }}" type="text" name="other_link" id="other_link" value="{{ old('other_link', '') }}">
                @if($errors->has('other_link'))
                    <span class="text-danger">{{ $errors->first('other_link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attorney.fields.other_link_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/attorneys/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', {{ $attorney->id ?? 0 }});
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.attorneys.storeMedia') }}',
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
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($attorney) && $attorney->photo)
      var file = {!! json_encode($attorney->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $attorney->photo->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
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
    url: '{{ route('admin.attorneys.storeMedia') }}',
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
@if(isset($attorney) && $attorney->banner)
      var file = {!! json_encode($attorney->banner) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $attorney->banner->getUrl('thumb') }}')
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
@endsection