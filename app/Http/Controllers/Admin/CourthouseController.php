<?php

namespace App\Http\Controllers\Admin;

use App\Courthouse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCourthouseRequest;
use App\Http\Requests\StoreCourthouseRequest;
use App\Http\Requests\UpdateCourthouseRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourthouseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('courthouse_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courthouses = Courthouse::all();

        return view('admin.courthouses.index', compact('courthouses'));
    }

    public function create()
    {
        abort_if(Gate::denies('courthouse_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courthouses.create');
    }

    public function store(StoreCourthouseRequest $request)
    {
        $courthouse = Courthouse::create($request->all());

        return redirect()->route('admin.courthouses.index');

    }

    public function edit(Courthouse $courthouse)
    {
        abort_if(Gate::denies('courthouse_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courthouses.edit', compact('courthouse'));
    }

    public function update(UpdateCourthouseRequest $request, Courthouse $courthouse)
    {
        $courthouse->update($request->all());

        return redirect()->route('admin.courthouses.index');

    }

    public function show(Courthouse $courthouse)
    {
        abort_if(Gate::denies('courthouse_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courthouse->load('courthouseAccounts');

        return view('admin.courthouses.show', compact('courthouse'));
    }

    public function destroy(Courthouse $courthouse)
    {
        abort_if(Gate::denies('courthouse_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courthouse->delete();

        return back();

    }

    public function massDestroy(MassDestroyCourthouseRequest $request)
    {
        Courthouse::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
