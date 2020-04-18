<?php

namespace App\Http\Requests;

use App\Post;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePostRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'title'            => [
                'required',
            ],
            'categories.*'     => [
                'integer',
            ],
            'categories'       => [
                'array',
            ],
            'tags.*'           => [
                'integer',
            ],
            'tags'             => [
                'array',
            ],
            'meta_title'       => [
                'max:55',
            ],
            'meta_description' => [
                'max:120',
            ],
        ];
    }
}
