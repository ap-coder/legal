<?php

namespace App\Http\Requests;

use App\Courthouse;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCourthouseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('courthouse_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:courthouses,id',
        ];

    }
}
