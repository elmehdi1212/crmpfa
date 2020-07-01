<?php

namespace App\Observers;

use App\Notifications\DataChangeEmailNotification;
use App\Notifications\AssignedReclamationNotification;
use App\Reclamation;
use Illuminate\Support\Facades\Notification;

class ReclamationActionObserver
{
    public function created(Reclamation $model)
    {
        $data  = ['action' => 'New Reclamation has been created!', 'model_name' => 'Reclamation', 'reclamation' => $model];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Reclamation $model)
    {
        if($model->isDirty('assigned_to_user_id'))
        {
            $user = $model->assigned_to_user;
            if($user)
            {
                Notification::send($user, new AssignedReclamationNotification($model));
            }
        }
    }
}
