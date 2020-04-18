<?php

namespace App\Http\Controllers\Admin;

use App\ContentCategory;
use App\ContentTag;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyServiceRequest;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Service;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServicesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::all();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        abort_if(Gate::denies('service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ContentCategory::all()->pluck('name', 'id');

        $tags = ContentTag::all()->pluck('name', 'id');

        return view('admin.services.create', compact('categories', 'tags'));
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

        return redirect()->route('admin.services.index');
    }

    public function edit(Service $service)
    {
        abort_if(Gate::denies('service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ContentCategory::all()->pluck('name', 'id');

        $tags = ContentTag::all()->pluck('name', 'id');

        $service->load('categories', 'tags');

        return view('admin.services.edit', compact('categories', 'tags', 'service'));
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

        return redirect()->route('admin.services.index');
    }

    public function show(Service $service)
    {
        abort_if(Gate::denies('service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service->load('categories', 'tags');

        return view('admin.services.show', compact('service'));
    }

    public function destroy(Service $service)
    {
        abort_if(Gate::denies('service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service->delete();

        return back();
    }

    public function massDestroy(MassDestroyServiceRequest $request)
    {
        Service::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
