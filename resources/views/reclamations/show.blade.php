@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Claim #{{ $reclamation->id }}</div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
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
                                        <a href="{{ $attachment->getUrl() }}">{{ $attachment->file_name }}</a>
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
                                        @if(!$loop->last)
                                            <hr />
                                        @endif
                                    @empty
                                        <div class="row">
                                            <div class="col">
                                                <p>There are no comments.</p>
                                            </div>
                                        </div>
                                    @endforelse
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="{{ route('reclamations.storeComment', $reclamation->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="comment_text">Leave a comment</label>
                            <textarea class="form-control @error('comment_text') is-invalid @enderror" id="comment_text" name="comment_text" rows="3" required></textarea>
                            @error('comment_text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('global.submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
