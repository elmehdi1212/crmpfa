<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReclamationRequest;
use App\Http\Requests\StoreReclamationRequest;
use App\Http\Requests\UpdateReclamationRequest;
use App\Priority;
use App\Status;
use App\Reclamation;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReclamationsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Reclamation::with(['status', 'priority', 'category', 'assigned_to_user', 'comments'])
                ->filterReclamations($request)
                ->select(sprintf('%s.*', (new Reclamation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'reclamation_show';
                $editGate      = 'reclamation_edit';
                $deleteGate    = 'reclamation_delete';
                $crudRoutePart = 'reclamations';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });
            $table->addColumn('status_color', function ($row) {
                return $row->status ? $row->status->color : '#000000';
            });

            $table->addColumn('priority_name', function ($row) {
                return $row->priority ? $row->priority->name : '';
            });
            $table->addColumn('priority_color', function ($row) {
                return $row->priority ? $row->priority->color : '#000000';
            });

            $table->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            });
            $table->addColumn('category_color', function ($row) {
                return $row->category ? $row->category->color : '#000000';
            });

            $table->editColumn('author_name', function ($row) {
                return $row->author_name ? $row->author_name : "";
            });
            $table->editColumn('author_email', function ($row) {
                return $row->author_email ? $row->author_email : "";
            });
            $table->addColumn('assigned_to_user_name', function ($row) {
                return $row->assigned_to_user ? $row->assigned_to_user->name : '';
            });

            $table->addColumn('comments_count', function ($row) {
                return $row->comments->count();
            });

            $table->addColumn('view_link', function ($row) {
                return route('admin.reclamations.show', $row->id);
            });

            $table->rawColumns(['actions', 'placeholder', 'status', 'priority', 'category', 'assigned_to_user']);

            return $table->make(true);
        }

        $priorities = Priority::all();
        $statuses = Status::all();
        $categories = Category::all();

        return view('admin.reclamations.index', compact('priorities', 'statuses', 'categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('reclamation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = Priority::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::whereHas('roles', function($query) {
                $query->whereId(3);
            })
            ->pluck('name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.reclamations.create', compact('statuses', 'priorities', 'categories', 'assigned_to_users'));
    }

    public function store(StoreReclamationRequest $request)
    {
        $reclamation = Reclamation::create($request->all());

        foreach ($request->input('attachments', []) as $file) {
            $reclamation->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachments');
        }

        return redirect()->route('admin.reclamations.index')->withSuccessMessage('successfully added');
    }

    public function edit(Reclamation $reclamation)
    {
        abort_if(Gate::denies('reclamation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = Priority::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_to_users = User::whereHas('roles', function($query) {
                $query->whereId(3);
            })
            ->pluck('name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $reclamation->load('status', 'priority', 'category', 'assigned_to_user');

        return view('admin.reclamations.edit', compact('statuses', 'priorities', 'categories', 'assigned_to_users', 'reclamation'));
    }

    public function update(UpdateReclamationRequest $request, Reclamation $reclamation)
    {
        $reclamation->update($request->all());

        if (count($reclamation->attachments) > 0) {
            foreach ($reclamation->attachments as $media) {
                if (!in_array($media->file_name, $request->input('attachments', []))) {
                    $media->delete();
                }
            }
        }

        $media = $reclamation->attachments->pluck('file_name')->toArray();

        foreach ($request->input('attachments', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $reclamation->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachments');
            }
        }

        return redirect()->route('admin.reclamations.index')->withSuccessMessage('successfully updated');
    }

    public function show(Reclamation $reclamation)
    {
        abort_if(Gate::denies('reclamation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reclamation->load('status', 'priority', 'category', 'assigned_to_user', 'comments');

        return view('admin.reclamations.show', compact('reclamation'));
    }

    public function destroy(Reclamation $reclamation)
    {
        abort_if(Gate::denies('reclamation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reclamation->delete();

        return back()->withSuccessMessage('successfully deleted');
    }

    public function massDestroy(MassDestroyReclamationRequest $request)
    {
        Reclamation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeComment(Request $request, Reclamation $reclamation)
    {
        $request->validate([
            'comment_text' => 'required'
        ]);
        $user = auth()->user();
        $comment = $reclamation->comments()->create([
            'author_name'   => $user->name,
            'author_email'  => $user->email,
            'user_id'       => $user->id,
            'comment_text'  => $request->comment_text
        ]);

        $reclamation->sendCommentNotification($comment);

        return redirect()->back()->withStatus('Your comment added successfully');
    }



}
