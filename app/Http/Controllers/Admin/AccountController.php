<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\CourtDate;
use App\Courthouse;
use App\CrmCustomer;
use App\CrmDocument;
use App\CrmNote;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAccountRequest;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accounts = Account::all();

        return view('admin.accounts.index', compact('accounts'));
    }

    public function create()
    {
        abort_if(Gate::denies('account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $court_dates = CourtDate::all()->pluck('courtdate', 'id');

        $notes = CrmNote::all()->pluck('note', 'id')->prepend(trans('global.pleaseSelect'), '');

        $documents = CrmDocument::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courthouses = Courthouse::all()->pluck('courthouse_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.accounts.create', compact('clients', 'court_dates', 'notes', 'documents', 'courthouses'));
    }

    public function store(StoreAccountRequest $request)
    {
        $account = Account::create($request->all());
        $account->court_dates()->sync($request->input('court_dates', []));

        return redirect()->route('admin.accounts.index');

    }

    public function edit(Account $account)
    {
        abort_if(Gate::denies('account_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $court_dates = CourtDate::all()->pluck('courtdate', 'id');

        $notes = CrmNote::all()->pluck('note', 'id')->prepend(trans('global.pleaseSelect'), '');

        $documents = CrmDocument::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courthouses = Courthouse::all()->pluck('courthouse_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $account->load('client', 'court_dates', 'notes', 'document', 'courthouse');

        return view('admin.accounts.edit', compact('clients', 'court_dates', 'notes', 'documents', 'courthouses', 'account'));
    }

    public function update(UpdateAccountRequest $request, Account $account)
    {
        $account->update($request->all());
        $account->court_dates()->sync($request->input('court_dates', []));

        return redirect()->route('admin.accounts.index');

    }

    public function show(Account $account)
    {
        abort_if(Gate::denies('account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account->load('client', 'court_dates', 'notes', 'document', 'courthouse');

        return view('admin.accounts.show', compact('account'));
    }

    public function destroy(Account $account)
    {
        abort_if(Gate::denies('account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account->delete();

        return back();

    }

    public function massDestroy(MassDestroyAccountRequest $request)
    {
        Account::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
