<?php

namespace App\Http\Requests;

use App\CourtCase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCourtCaseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('court_case_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'closed_date'    => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
            'completed_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
            'attorneys.*'    => [
                'integer'],
            'attorneys'      => [
                'array'],
            'employees.*'    => [
                'integer'],
            'employees'      => [
                'array'],
        ];

    }
}
