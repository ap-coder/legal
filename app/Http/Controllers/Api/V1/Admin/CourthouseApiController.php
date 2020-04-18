<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Courthouse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourthouseRequest;
use App\Http\Requests\UpdateCourthouseRequest;
use App\Http\Resources\Admin\CourthouseResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourthouseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('courthouse_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourthouseResource(Courthouse::all());

    }

    public function store(StoreCourthouseRequest $request)
    {
        $courthouse = Courthouse::create($request->all());

        return (new CourthouseResource($courthouse))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Courthouse $courthouse)
    {
        abort_if(Gate::denies('courthouse_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourthouseResource($courthouse);

    }

    public function update(UpdateCourthouseRequest $request, Courthouse $courthouse)
    {
        $courthouse->update($request->all());

        return (new CourthouseResource($courthouse))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Courthouse $courthouse)
    {
        abort_if(Gate::denies('courthouse_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courthouse->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
