@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.courtCase.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.court-cases.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="client_id">{{ trans('cruds.courtCase.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtCase.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="case_name">{{ trans('cruds.courtCase.fields.case_name') }}</label>
                <input class="form-control {{ $errors->has('case_name') ? 'is-invalid' : '' }}" type="text" name="case_name" id="case_name" value="{{ old('case_name', '') }}">
                @if($errors->has('case_name'))
                    <span class="text-danger">{{ $errors->first('case_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtCase.fields.case_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="case_number">{{ trans('cruds.courtCase.fields.case_number') }}</label>
                <input class="form-control {{ $errors->has('case_number') ? 'is-invalid' : '' }}" type="text" name="case_number" id="case_number" value="{{ old('case_number', '') }}">
                @if($errors->has('case_number'))
                    <span class="text-danger">{{ $errors->first('case_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtCase.fields.case_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="awarded_value">{{ trans('cruds.courtCase.fields.awarded_value') }}</label>
                <input class="form-control {{ $errors->has('awarded_value') ? 'is-invalid' : '' }}" type="number" name="awarded_value" id="awarded_value" value="{{ old('awarded_value', '0') }}" step="0.01">
                @if($errors->has('awarded_value'))
                    <span class="text-danger">{{ $errors->first('awarded_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtCase.fields.awarded_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="proposed_value">{{ trans('cruds.courtCase.fields.proposed_value') }}</label>
                <input class="form-control {{ $errors->has('proposed_value') ? 'is-invalid' : '' }}" type="number" name="proposed_value" id="proposed_value" value="{{ old('proposed_value', '0') }}" step="0.01">
                @if($errors->has('proposed_value'))
                    <span class="text-danger">{{ $errors->first('proposed_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtCase.fields.proposed_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="closed_date">{{ trans('cruds.courtCase.fields.closed_date') }}</label>
                <input class="form-control date {{ $errors->has('closed_date') ? 'is-invalid' : '' }}" type="text" name="closed_date" id="closed_date" value="{{ old('closed_date') }}">
                @if($errors->has('closed_date'))
                    <span class="text-danger">{{ $errors->first('closed_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtCase.fields.closed_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="completed_date">{{ trans('cruds.courtCase.fields.completed_date') }}</label>
                <input class="form-control date {{ $errors->has('completed_date') ? 'is-invalid' : '' }}" type="text" name="completed_date" id="completed_date" value="{{ old('completed_date') }}">
                @if($errors->has('completed_date'))
                    <span class="text-danger">{{ $errors->first('completed_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtCase.fields.completed_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attorneys">{{ trans('cruds.courtCase.fields.attorneys') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('attorneys') ? 'is-invalid' : '' }}" name="attorneys[]" id="attorneys" multiple>
                    @foreach($attorneys as $id => $attorneys)
                        <option value="{{ $id }}" {{ in_array($id, old('attorneys', [])) ? 'selected' : '' }}>{{ $attorneys }}</option>
                    @endforeach
                </select>
                @if($errors->has('attorneys'))
                    <span class="text-danger">{{ $errors->first('attorneys') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtCase.fields.attorneys_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="employees">{{ trans('cruds.courtCase.fields.employees') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('employees') ? 'is-invalid' : '' }}" name="employees[]" id="employees" multiple>
                    @foreach($employees as $id => $employees)
                        <option value="{{ $id }}" {{ in_array($id, old('employees', [])) ? 'selected' : '' }}>{{ $employees }}</option>
                    @endforeach
                </select>
                @if($errors->has('employees'))
                    <span class="text-danger">{{ $errors->first('employees') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courtCase.fields.employees_helper') }}</span>
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