@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.courtDate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.court-dates.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="client_id">{{ trans('cruds.courtDate.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtDate.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="court_cases">{{ trans('cruds.courtDate.fields.court_case') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('court_cases') ? 'is-invalid' : '' }}" name="court_cases[]" id="court_cases" multiple>
                    @foreach($court_cases as $id => $court_case)
                        <option value="{{ $id }}" {{ in_array($id, old('court_cases', [])) ? 'selected' : '' }}>{{ $court_case }}</option>
                    @endforeach
                </select>
                @if($errors->has('court_cases'))
                    <span class="text-danger">{{ $errors->first('court_cases') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtDate.fields.court_case_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="courthouse_id">{{ trans('cruds.courtDate.fields.courthouse') }}</label>
                <select class="form-control select2 {{ $errors->has('courthouse') ? 'is-invalid' : '' }}" name="courthouse_id" id="courthouse_id">
                    @foreach($courthouses as $id => $courthouse)
                        <option value="{{ $id }}" {{ old('courthouse_id') == $id ? 'selected' : '' }}>{{ $courthouse }}</option>
                    @endforeach
                </select>
                @if($errors->has('courthouse'))
                    <span class="text-danger">{{ $errors->first('courthouse') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtDate.fields.courthouse_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="docket_number">{{ trans('cruds.courtDate.fields.docket_number') }}</label>
                <input class="form-control {{ $errors->has('docket_number') ? 'is-invalid' : '' }}" type="text" name="docket_number" id="docket_number" value="{{ old('docket_number', '') }}">
                @if($errors->has('docket_number'))
                    <span class="text-danger">{{ $errors->first('docket_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtDate.fields.docket_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="courtdate">{{ trans('cruds.courtDate.fields.courtdate') }}</label>
                <input class="form-control datetime {{ $errors->has('courtdate') ? 'is-invalid' : '' }}" type="text" name="courtdate" id="courtdate" value="{{ old('courtdate') }}">
                @if($errors->has('courtdate'))
                    <span class="text-danger">{{ $errors->first('courtdate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtDate.fields.courtdate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="needed">{{ trans('cruds.courtDate.fields.needed') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('needed') ? 'is-invalid' : '' }}" name="needed" id="needed">{!! old('needed') !!}</textarea>
                @if($errors->has('needed'))
                    <span class="text-danger">{{ $errors->first('needed') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtDate.fields.needed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="outcome">{{ trans('cruds.courtDate.fields.outcome') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('outcome') ? 'is-invalid' : '' }}" name="outcome" id="outcome">{!! old('outcome') !!}</textarea>
                @if($errors->has('outcome'))
                    <span class="text-danger">{{ $errors->first('outcome') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtDate.fields.outcome_helper') }}</span>
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
                xhr.open('POST', '/admin/court-dates/ckmedia', true);
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
                data.append('crud_id', {{ $courtDate->id ?? 0 }});
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

@endsection