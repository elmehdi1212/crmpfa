@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.reclamation.title') }}
    </div>

    <div class="card-body">
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.reclamation.fields.id') }}
                        </th>
                        <td>
                            {{ $reclamation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reclamation.fields.created_at') }}
                        </th>
                        <td>
                            {{ $reclamation->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reclamation.fields.title') }}
                        </th>
                        <td>
                            {{ $reclamation->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reclamation.fields.content') }}
                        </th>
                        <td>
                            {!! $reclamation->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reclamation.fields.attachments') }}
                        </th>
                        <td>
                            @foreach($reclamation->attachments as $attachment)
                                <a href="{{ $attachment->getUrl() }}" target="_blank">{{ $attachment->file_name }}</a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reclamation.fields.status') }}
                        </th>
                        <td>
                            {{ $reclamation->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reclamation.fields.priority') }}
                        </th>
                        <td>
                            {{ $reclamation->priority->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reclamation.fields.category') }}
                        </th>
                        <td>
                            {{ $reclamation->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reclamation.fields.author_name') }}
                        </th>
                        <td>
                            {{ $reclamation->author_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reclamation.fields.author_email') }}
                        </th>
                        <td>
                            {{ $reclamation->author_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reclamation.fields.assigned_to_user') }}
                        </th>
                        <td>
                            {{ $reclamation->assigned_to_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reclamation.fields.comments') }}
                        </th>
                        <td>
                            @forelse ($reclamation->comments as $comment)
                                <div class="row">
                                    <div class="col">
                                        <p class="font-weight-bold"><a href="mailto:{{ $comment->author_email }}">{{ $comment->author_name }}</a> ({{ $comment->created_at }})</p>
                                        <p>{{ $comment->comment_text }}</p>
                                    </div>
                                </div>
                                <hr />
                            @empty
                                <div class="row">
                                    <div class="col">
                                        <p>There are no comments.</p>
                                    </div>
                                </div>
                                <hr />
                            @endforelse
                            <form action="{{ route('admin.reclamations.storeComment', $reclamation->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="comment_text">Leave a comment</label>
                                    <textarea class="form-control" id="comment_text" name="comment_text" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">@lang('global.submit')</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a class="btn btn-default my-2" href="{{ route('admin.reclamations.index') }}">
            {{ trans('global.back_to_list') }}
        </a>

        <a href="{{ route('admin.reclamations.edit', $reclamation->id) }}" class="btn btn-primary">
            @lang('global.edit') @lang('cruds.reclamation.title_singular')
        </a>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
    </div>
</div>
@endsection