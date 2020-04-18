@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.courthouse.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.courthouses.update", [$courthouse->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="courthouse_name">{{ trans('cruds.courthouse.fields.courthouse_name') }}</label>
                <input class="form-control {{ $errors->has('courthouse_name') ? 'is-invalid' : '' }}" type="text" name="courthouse_name" id="courthouse_name" value="{{ old('courthouse_name', $courthouse->courthouse_name) }}">
                @if($errors->has('courthouse_name'))
                    <span class="text-danger">{{ $errors->first('courthouse_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courthouse.fields.courthouse_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="courthouse_street">{{ trans('cruds.courthouse.fields.courthouse_street') }}</label>
                <input class="form-control {{ $errors->has('courthouse_street') ? 'is-invalid' : '' }}" type="text" name="courthouse_street" id="courthouse_street" value="{{ old('courthouse_street', $courthouse->courthouse_street) }}">
                @if($errors->has('courthouse_street'))
                    <span class="text-danger">{{ $errors->first('courthouse_street') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courthouse.fields.courthouse_street_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="courthouse_street_2">{{ trans('cruds.courthouse.fields.courthouse_street_2') }}</label>
                <input class="form-control {{ $errors->has('courthouse_street_2') ? 'is-invalid' : '' }}" type="text" name="courthouse_street_2" id="courthouse_street_2" value="{{ old('courthouse_street_2', $courthouse->courthouse_street_2) }}">
                @if($errors->has('courthouse_street_2'))
                    <span class="text-danger">{{ $errors->first('courthouse_street_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courthouse.fields.courthouse_street_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="courthouse_city">{{ trans('cruds.courthouse.fields.courthouse_city') }}</label>
                <input class="form-control {{ $errors->has('courthouse_city') ? 'is-invalid' : '' }}" type="text" name="courthouse_city" id="courthouse_city" value="{{ old('courthouse_city', $courthouse->courthouse_city) }}">
                @if($errors->has('courthouse_city'))
                    <span class="text-danger">{{ $errors->first('courthouse_city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courthouse.fields.courthouse_city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="courthouse_state">{{ trans('cruds.courthouse.fields.courthouse_state') }}</label>
                <input class="form-control {{ $errors->has('courthouse_state') ? 'is-invalid' : '' }}" type="text" name="courthouse_state" id="courthouse_state" value="{{ old('courthouse_state', $courthouse->courthouse_state) }}">
                @if($errors->has('courthouse_state'))
                    <span class="text-danger">{{ $errors->first('courthouse_state') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courthouse.fields.courthouse_state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="courthouse_zip">{{ trans('cruds.courthouse.fields.courthouse_zip') }}</label>
                <input class="form-control {{ $errors->has('courthouse_zip') ? 'is-invalid' : '' }}" type="text" name="courthouse_zip" id="courthouse_zip" value="{{ old('courthouse_zip', $courthouse->courthouse_zip) }}">
                @if($errors->has('courthouse_zip'))
                    <span class="text-danger">{{ $errors->first('courthouse_zip') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courthouse.fields.courthouse_zip_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="googlemaps_url">{{ trans('cruds.courthouse.fields.googlemaps_url') }}</label>
                <input class="form-control {{ $errors->has('googlemaps_url') ? 'is-invalid' : '' }}" type="text" name="googlemaps_url" id="googlemaps_url" value="{{ old('googlemaps_url', $courthouse->googlemaps_url) }}">
                @if($errors->has('googlemaps_url'))
                    <span class="text-danger">{{ $errors->first('googlemaps_url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courthouse.fields.googlemaps_url_helper') }}</span>
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