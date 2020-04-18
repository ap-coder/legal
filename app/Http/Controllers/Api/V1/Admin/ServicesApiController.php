<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\Admin\ServiceResource;
use App\Service;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServicesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServiceResource(Service::with(['categories', 'tags'])->get());
    }

    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->all());
        $service->categories()->sync($request->input('categories', []));
        $service->tags()->sync($request->input('tags', []));

        if ($request->input('featured_image', false)) {
            $service->addMedia(storage_path('tmp/uploads/' . $request->input('featured_image')))->toMediaCollection('featured_image');
        }

        if ($request->input('banner', false)) {
            $service->addMedia(storage_path('tmp/uploads/' . $request->input('banner')))->toMediaCollection('banner');
        }

        return (new ServiceResource($service))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Service $service)
    {
        abort_if(Gate::denies('service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServiceResource($service->load(['categories', 'tags']));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->all());
        $service->categories()->sync($request->input('categories', []));
        $service->tags()->sync($request->input('tags', []));

        if ($request->input('featured_image', false)) {
            if (!$service->featured_image || $request->input('featured_image') !== $service->featured_image->file_name) {
                $service->addMedia(storage_path('tmp/uploads/' . $request->input('featured_image')))->toMediaCollection('featured_image');
            }
        } elseif ($service->featured_image) {
            $service->featured_image->delete();
        }

        if ($request->input('banner', false)) {
            if (!$service->banner || $request->input('banner') !== $service->banner->file_name) {
                $service->addMedia(storage_path('tmp/uploads/' . $request->input('banner')))->toMediaCollection('banner');
            }
        } elseif ($service->banner) {
            $service->banner->delete();
        }

        return (new ServiceResource($service))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Service $service)
    {
        abort_if(Gate::denies('service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
