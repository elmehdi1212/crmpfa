@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.article.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.article.fields.name') }}
                    </th>
                    <td>
                        {{ $article->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.article.fields.description') }}
                    </th>
                    <td>
                        {!! $article->description !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.article.fields.price') }}
                    </th>
                    <td>
                        ${{ $article->price }}
                    </td>
                </tr>
            </tbody>
        </table>
        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
</div>

@endsection