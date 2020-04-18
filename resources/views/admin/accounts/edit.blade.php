@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.account.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.accounts.update", [$account->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.account.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Account::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $account->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.account.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.account.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ ($account->client ? $account->client->id : old('client_id')) == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.account.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="court_dates">{{ trans('cruds.account.fields.court_dates') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('court_dates') ? 'is-invalid' : '' }}" name="court_dates[]" id="court_dates" multiple>
                    @foreach($court_dates as $id => $court_dates)
                        <option value="{{ $id }}" {{ (in_array($id, old('court_dates', [])) || $account->court_dates->contains($id)) ? 'selected' : '' }}>{{ $court_dates }}</option>
                    @endforeach
                </select>
                @if($errors->has('court_dates'))
                    <span class="text-danger">{{ $errors->first('court_dates') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.account.fields.court_dates_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes_id">{{ trans('cruds.account.fields.notes') }}</label>
                <select class="form-control select2 {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes_id" id="notes_id">
                    @foreach($notes as $id => $notes)
                        <option value="{{ $id }}" {{ ($account->notes ? $account->notes->id : old('notes_id')) == $id ? 'selected' : '' }}>{{ $notes }}</option>
                    @endforeach
                </select>
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.account.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="document_id">{{ trans('cruds.account.fields.document') }}</label>
                <select class="form-control select2 {{ $errors->has('document') ? 'is-invalid' : '' }}" name="document_id" id="document_id">
                    @foreach($documents as $id => $document)
                        <option value="{{ $id }}" {{ ($account->document ? $account->document->id : old('document_id')) == $id ? 'selected' : '' }}>{{ $document }}</option>
                    @endforeach
                </select>
                @if($errors->has('document'))
                    <span class="text-danger">{{ $errors->first('document') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.account.fields.document_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="courthouse_id">{{ trans('cruds.account.fields.courthouse') }}</label>
                <select class="form-control select2 {{ $errors->has('courthouse') ? 'is-invalid' : '' }}" name="courthouse_id" id="courthouse_id">
                    @foreach($courthouses as $id => $courthouse)
                        <option value="{{ $id }}" {{ ($account->courthouse ? $account->courthouse->id : old('courthouse_id')) == $id ? 'selected' : '' }}>{{ $courthouse }}</option>
                    @endforeach
                </select>
                @if($errors->has('courthouse'))
                    <span class="text-danger">{{ $errors->first('courthouse') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.account.fields.courthouse_helper') }}</span>
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