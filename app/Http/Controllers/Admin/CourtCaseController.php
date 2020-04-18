<?php

namespace App\Http\Controllers\Admin;

use App\Attorney;
use App\CourtCase;
use App\CrmCustomer;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCourtCaseRequest;
use App\Http\Requests\StoreCourtCaseRequest;
use App\Http\Requests\UpdateCourtCaseRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourtCaseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('court_case_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courtCases = CourtCase::all();

        return view('admin.courtCases.index', compact('courtCases'));
    }

    public function create()
    {
        abort_if(Gate::denies('court_case_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attorneys = Attorney::all()->pluck('name', 'id');

        $employees = Employee::all()->pluck('name', 'id');

        return view('admin.courtCases.create', compact('clients', 'attorneys', 'employees'));
    }

    public function store(StoreCourtCaseRequest $request)
    {
        $courtCase = CourtCase::create($request->all());
        $courtCase->attorneys()->sync($request->input('attorneys', []));
        $courtCase->employees()->sync($request->input('employees', []));

        return redirect()->route('admin.court-cases.index');

    }

    public function edit(CourtCase $courtCase)
    {
        abort_if(Gate::denies('court_case_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attorneys = Attorney::all()->pluck('name', 'id');

        $employees = Employee::all()->pluck('name', 'id');

        $courtCase->load('client', 'attorneys', 'employees');

        return view('admin.courtCases.edit', compact('clients', 'attorneys', 'employees', 'courtCase'));
    }

    public function update(UpdateCourtCaseRequest $request, CourtCase $courtCase)
    {
        $courtCase->update($request->all());
        $courtCase->attorneys()->sync($request->input('attorneys', []));
        $courtCase->employees()->sync($request->input('employees', []));

        return redirect()->route('admin.court-cases.index');

    }

    public function show(CourtCase $courtCase)
    {
        abort_if(Gate::denies('court_case_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courtCase->load('client', 'attorneys', 'employees');

        return view('admin.courtCases.show', compact('courtCase'));
    }

    public function destroy(CourtCase $courtCase)
    {
        abort_if(Gate::denies('court_case_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courtCase->delete();

        return back();

    }

    public function massDestroy(MassDestroyCourtCaseRequest $request)
    {
        CourtCase::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
