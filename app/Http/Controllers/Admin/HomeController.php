<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Symfony\Component\HttpFoundation\Response;

use App\Reclamation;
use App\User;
use Carbon\Carbon;

class HomeController
{
    public function index()
    {
        abort_if(Gate::denies('dashboard_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $totalReclamations = Reclamation::count();
        $user=User::count();
       
        $openReclamations = Reclamation::whereHas('status', function($query) {
            $query->whereName('Open');
        })->count();
        $closedReclamations = Reclamation::whereHas('status', function($query) {
            $query->whereName('Closed');
        })->count();

        $users = User::select('id', 'created_at')->get()->groupBy(function($date) {
     //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
     return Carbon::parse($date->created_at)->format('m'); // grouping by months
    });

      $usermcount = [];
      $userArr = [];

    foreach ($users as $key => $value) {
    $usermcount[(int)$key] = count($value);
}
    for($i = 1; $i <= 12; $i++){
       if(!empty($usermcount[$i])){
        $userArr[$i] = $usermcount[$i];    
      }else{
        $userArr[$i] = 0;    
    }
}

        return view('home', compact('totalReclamations','user','openReclamations', 'closedReclamations','usermcount')); 
    }
}
