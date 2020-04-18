<?php

namespace App\Http\Controllers\Admin;

use App\Attorney;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAttorneyRequest;
use App\Http\Requests\StoreAttorneyRequest;
use App\Http\Requests\UpdateAttorneyRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AttorneyController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('attorney_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attorneys = Attorney::all();

        return view('admin.attorneys.index', compact('attorneys'));
    }

    public function create()
    {
        abort_if(Gate::denies('attorney_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attorneys.create');
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $attorney->id]);
        }

        return redirect()->route('admin.attorneys.index');

    }

    public function edit(Attorney $attorney)
    {
        abort_if(Gate::denies('attorney_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attorneys.edit', compact('attorney'));
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

        return redirect()->route('admin.attorneys.index');

    }

    public function show(Attorney $attorney)
    {
        abort_if(Gate::denies('attorney_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attorney->load('attorneysCourtCases');

        return view('admin.attorneys.show', compact('attorney'));
    }

    public function destroy(Attorney $attorney)
    {
        abort_if(Gate::denies('attorney_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attorney->delete();

        return back();

    }

    public function massDestroy(MassDestroyAttorneyRequest $request)
    {
        Attorney::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('attorney_create') && Gate::denies('attorney_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Attorney();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
