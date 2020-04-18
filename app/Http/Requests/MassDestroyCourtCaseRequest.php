<?php

namespace App\Http\Requests;

use App\CourtCase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCourtCaseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('court_case_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:court_cases,id',
        ];

    }
}
