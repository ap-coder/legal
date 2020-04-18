<?php

namespace App\Http\Requests;

use App\CourtDate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCourtDateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('court_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:court_dates,id',
        ];

    }
}
