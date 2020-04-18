<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\Admin\AccountResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccountResource(Account::with(['client', 'court_dates', 'notes', 'document', 'courthouse'])->get());

    }

    public function store(StoreAccountRequest $request)
    {
        $account = Account::create($request->all());
        $account->court_dates()->sync($request->input('court_dates', []));

        return (new AccountResource($account))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Account $account)
    {
        abort_if(Gate::denies('account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccountResource($account->load(['client', 'court_dates', 'notes', 'document', 'courthouse']));

    }

    public function update(UpdateAccountRequest $request, Account $account)
    {
        $account->update($request->all());
        $account->court_dates()->sync($request->input('court_dates', []));

        return (new AccountResource($account))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Account $account)
    {
        abort_if(Gate::denies('account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
