<?php

namespace App\Http\Controllers\Admin;

use App\CourtCase;
use App\CourtDate;
use App\Courthouse;
use App\CrmCustomer;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourtDateRequest;
use App\Http\Requests\StoreCourtDateRequest;
use App\Http\Requests\UpdateCourtDateRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CourtDateController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('court_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courtDates = CourtDate::all();

        return view('admin.courtDates.index', compact('courtDates'));
    }

    public function create()
    {
        abort_if(Gate::denies('court_date_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $court_cases = CourtCase::all()->pluck('case_name', 'id');

        $courthouses = Courthouse::all()->pluck('courthouse_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.courtDates.create', compact('clients', 'court_cases', 'courthouses'));
    }

    public function store(StoreCourtDateRequest $request)
    {
        $courtDate = CourtDate::create($request->all());
        $courtDate->court_cases()->sync($request->input('court_cases', []));

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $courtDate->id]);
        }

        return redirect()->route('admin.court-dates.index');

    }

    public function edit(CourtDate $courtDate)
    {
        abort_if(Gate::denies('court_date_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $court_cases = CourtCase::all()->pluck('case_name', 'id');

        $courthouses = Courthouse::all()->pluck('courthouse_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courtDate->load('client', 'court_cases', 'courthouse');

        return view('admin.courtDates.edit', compact('clients', 'court_cases', 'courthouses', 'courtDate'));
    }

    public function update(UpdateCourtDateRequest $request, CourtDate $courtDate)
    {
        $courtDate->update($request->all());
        $courtDate->court_cases()->sync($request->input('court_cases', []));

        return redirect()->route('admin.court-dates.index');

    }

    public function show(CourtDate $courtDate)
    {
        abort_if(Gate::denies('court_date_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courtDate->load('client', 'court_cases', 'courthouse', 'courtDatesAccounts');

        return view('admin.courtDates.show', compact('courtDate'));
    }

    public function destroy(CourtDate $courtDate)
    {
        abort_if(Gate::denies('court_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courtDate->delete();

        return back();

    }

    public function massDestroy(MassDestroyCourtDateRequest $request)
    {
        CourtDate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('court_date_create') && Gate::denies('court_date_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CourtDate();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
