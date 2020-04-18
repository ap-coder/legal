<?php

namespace App\Http\Requests;

use App\Attorney;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAttorneyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('attorney_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'intro' => [
                'max:130'],
        ];

    }
}
