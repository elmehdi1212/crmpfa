<?php

namespace App\Http\Controllers;

use App\Reclamation;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Notifications\CommentEmailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;

class ReclamationController extends Controller
{
    use MediaUploadingTrait;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reclamations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'content'       => 'required',
            'author_name'   => 'required',
            'author_email'  => 'required|email',
        ]);

        $request->request->add([
            'category_id'   => 1,
            'status_id'     => 1,
            'priority_id'   => 1
        ]);

        $reclamation = Reclamation::create($request->all());

        foreach ($request->input('attachments', []) as $file) {
            $reclamation->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachments');
        }

        return redirect()->back()->withStatus('Your claim has been submitted, we will be in touch. You can view Claim status <a href="'.route('reclamations.show', $reclamation->id).'">here</a>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function show(Reclamation $reclamation)
    {
        $reclamation->load('comments');

        return view('reclamations.show', compact('reclamation'));
    }

    public function storeComment(Request $request, Reclamation $reclamation)
    {
        $request->validate([
            'comment_text' => 'required'
        ]);

        $comment = $reclamation->comments()->create([
            'author_name'   => $reclamation->author_name,
            'author_email'  => $reclamation->author_email,
            'comment_text'  => $request->comment_text
        ]);

        $reclamation->sendCommentNotification($comment);

        return redirect()->back()->withStatus('Your comment added successfully');
    }
}
