@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.crmNote.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.crm-notes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="note">{{ trans('cruds.crmNote.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note" required>{{ old('note') }}</textarea>
                @if($errors->has('note'))
                    <span class="text-danger">{{ $errors->first('note') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmNote.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="customer_id">{{ trans('cruds.crmNote.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id" required>
                    @foreach($customers as $id => $customer)
                        <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $customer }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer'))
                    <span class="text-danger">{{ $errors->first('customer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmNote.fields.customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="court_case_id">{{ trans('cruds.crmNote.fields.court_case') }}</label>
                <select class="form-control select2 {{ $errors->has('court_case') ? 'is-invalid' : '' }}" name="court_case_id" id="court_case_id">
                    @foreach($court_cases as $id => $court_case)
                        <option value="{{ $id }}" {{ old('court_case_id') == $id ? 'selected' : '' }}>{{ $court_case }}</option>
                    @endforeach
                </select>
                @if($errors->has('court_case'))
                    <span class="text-danger">{{ $errors->first('court_case') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crmNote.fields.court_case_helper') }}</span>
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