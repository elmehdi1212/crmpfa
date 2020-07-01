<?php

use App\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        User::findOrFail(1)->roles()->sync(1);
        User::findOrFail(2)->roles()->sync(3);
        User::findOrFail(3)->roles()->sync(2);
    //  foreach(range(4,30) as $id){
     // User::findOrFail($id)->roles()->sync(2);
   //     }
    //  foreach(range(31,43) as $id){
    //      User::findOrFail($id)->roles()->sync(3);
    //}
    }
}
