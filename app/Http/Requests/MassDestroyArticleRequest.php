<?php

namespace App\Http\Requests;

use App\Article;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyArticleRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('article_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:articles,id',
        ];
    }
}
