<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreReclamationRequest;
use App\Http\Requests\UpdateReclamationRequest;
use App\Http\Resources\Admin\ReclamationResource;
use App\Reclamation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReclamationsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('reclamation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReclamationResource(Reclamation::with(['status', 'priority', 'category', 'assigned_to_user'])->get());
    }

    public function store(StoreReclamationRequest $request)
    {
        $reclamation = Reclamation::create($request->all());

        if ($request->input('attachments', false)) {
            $reclamation->addMedia(storage_path('tmp/uploads/' . $request->input('attachments')))->toMediaCollection('attachments');
        }

        return (new ReclamationResource($reclamation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Reclamation $reclamation)
    {
        abort_if(Gate::denies('reclamation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new  ReclamationResource($reclamation->load(['status', 'priority', 'category', 'assigned_to_user']));
    }

    public function update(UpdateReclamationRequest $request, Reclamation $reclamation)
    {
        $reclamation->update($request->all());

        if ($request->input('attachments', false)) {
            if (!$reclamation->attachments || $request->input('attachments') !== $reclamation->attachments->file_name) {
                $reclamation->addMedia(storage_path('tmp/uploads/' . $request->input('attachments')))->toMediaCollection('attachments');
            }
        } elseif ($reclamation->attachments) {
            $reclamation->attachments->delete();
        }

        return (new ReclamationResource($reclamation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Reclamation $reclamation)
    {
        abort_if(Gate::denies('reclamation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reclamation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
