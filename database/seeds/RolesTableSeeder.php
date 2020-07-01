<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [[
            'id'         => 1,
            'title'      => 'Admin',
            'created_at' => '2020-04-15 19:13:32',
            'updated_at' => '2020-04-15 19:13:32',
            'deleted_at' => null,
        ],
            [
                'id'         => 2,
                'title'      => 'Customer',
                'created_at' => '2020-04-15 19:13:32',
                'updated_at' => '2020-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'title'      => 'Responsible',
                'created_at' => '2020-04-15 19:13:32',
                'updated_at' => '2020-04-15 19:13:32',
                'deleted_at' => null,
            ]
        ];

        Role::insert($roles);
    }
}
