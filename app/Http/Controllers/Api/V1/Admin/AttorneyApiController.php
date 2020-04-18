<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Attorney;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAttorneyRequest;
use App\Http\Requests\UpdateAttorneyRequest;
use App\Http\Resources\Admin\AttorneyResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttorneyApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('attorney_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttorneyResource(Attorney::all());

    }

    public function store(StoreAttorneyRequest $request)
    {
        $attorney = Attorney::create($request->all());

        if ($request->input('photo', false)) {
            $attorney->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($request->input('banner', false)) {
            $attorney->addMedia(storage_path('tmp/uploads/' . $request->input('banner')))->toMediaCollection('banner');
        }

        return (new AttorneyResource($attorney))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Attorney $attorney)
    {
        abort_if(Gate::denies('attorney_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttorneyResource($attorney);

    }

    public function update(UpdateAttorneyRequest $request, Attorney $attorney)
    {
        $attorney->update($request->all());

        if ($request->input('photo', false)) {
            if (!$attorney->photo || $request->input('photo') !== $attorney->photo->file_name) {
                $attorney->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }

        } elseif ($attorney->photo) {
            $attorney->photo->delete();
        }

        if ($request->input('banner', false)) {
            if (!$attorney->banner || $request->input('banner') !== $attorney->banner->file_name) {
                $attorney->addMedia(storage_path('tmp/uploads/' . $request->input('banner')))->toMediaCollection('banner');
            }

        } elseif ($attorney->banner) {
            $attorney->banner->delete();
        }

        return (new AttorneyResource($attorney))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Attorney $attorney)
    {
        abort_if(Gate::denies('attorney_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attorney->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
