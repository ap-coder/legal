<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\CourtDate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCourtDateRequest;
use App\Http\Requests\UpdateCourtDateRequest;
use App\Http\Resources\Admin\CourtDateResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourtDateApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('court_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourtDateResource(CourtDate::with(['client', 'court_cases', 'courthouse'])->get());

    }

    public function store(StoreCourtDateRequest $request)
    {
        $courtDate = CourtDate::create($request->all());
        $courtDate->court_cases()->sync($request->input('court_cases', []));

        return (new CourtDateResource($courtDate))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(CourtDate $courtDate)
    {
        abort_if(Gate::denies('court_date_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourtDateResource($courtDate->load(['client', 'court_cases', 'courthouse']));

    }

    public function update(UpdateCourtDateRequest $request, CourtDate $courtDate)
    {
        $courtDate->update($request->all());
        $courtDate->court_cases()->sync($request->input('court_cases', []));

        return (new CourtDateResource($courtDate))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(CourtDate $courtDate)
    {
        abort_if(Gate::denies('court_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courtDate->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
