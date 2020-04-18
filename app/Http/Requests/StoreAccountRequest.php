<?php

namespace App\Http\Requests;

use App\Account;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAccountRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'client_id'     => [
                'required',
                'integer'],
            'court_dates.*' => [
                'integer'],
            'court_dates'   => [
                'array'],
        ];

    }
}
