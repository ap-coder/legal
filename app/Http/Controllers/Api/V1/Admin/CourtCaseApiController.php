<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\CourtCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourtCaseRequest;
use App\Http\Requests\UpdateCourtCaseRequest;
use App\Http\Resources\Admin\CourtCaseResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourtCaseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('court_case_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourtCaseResource(CourtCase::with(['client', 'attorneys', 'employees'])->get());

    }

    public function store(StoreCourtCaseRequest $request)
    {
        $courtCase = CourtCase::create($request->all());
        $courtCase->attorneys()->sync($request->input('attorneys', []));
        $courtCase->employees()->sync($request->input('employees', []));

        return (new CourtCaseResource($courtCase))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(CourtCase $courtCase)
    {
        abort_if(Gate::denies('court_case_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourtCaseResource($courtCase->load(['client', 'attorneys', 'employees']));

    }

    public function update(UpdateCourtCaseRequest $request, CourtCase $courtCase)
    {
        $courtCase->update($request->all());
        $courtCase->attorneys()->sync($request->input('attorneys', []));
        $courtCase->employees()->sync($request->input('employees', []));

        return (new CourtCaseResource($courtCase))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(CourtCase $courtCase)
    {
        abort_if(Gate::denies('court_case_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courtCase->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
