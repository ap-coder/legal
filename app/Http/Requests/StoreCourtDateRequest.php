<?php

namespace App\Http\Requests;

use App\CourtDate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCourtDateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('court_date_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'court_cases.*' => [
                'integer'],
            'court_cases'   => [
                'array'],
            'courtdate'     => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable'],
        ];

    }
}
