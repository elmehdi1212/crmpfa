<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'article_create',
            ],
            [
                'id'    => '18',
                'title' => 'article_edit',
            ],
            [
                'id'    => '19',
                'title' => 'article_show',
            ],
            [
                'id'    => '20',
                'title' => 'article_delete',
            ],
            [
                'id'    => '21',
                'title' => 'article_access',
            ],
            [
                'id'    => '22',
                'title' => 'status_create',
            ],
            [
                'id'    => '23',
                'title' => 'status_edit',
            ],
            [
                'id'    => '24',
                'title' => 'status_show',
            ],
            [
                'id'    => '25',
                'title' => 'status_delete',
            ],
            [
                'id'    => '26',
                'title' => 'status_access',
            ],
            [
                'id'    => '27',
                'title' => 'priority_create',
            ],
            [
                'id'    => '28',
                'title' => 'priority_edit',
            ],
            [
                'id'    => '29',
                'title' => 'priority_show',
            ],
            [
                'id'    => '30',
                'title' => 'priority_delete',
            ],
            [
                'id'    => '31',
                'title' => 'priority_access',
            ],
            [
                'id'    => '32',
                'title' => 'category_create',
            ],
            [
                'id'    => '33',
                'title' => 'category_edit',
            ],
            [
                'id'    => '34',
                'title' => 'category_show',
            ],
            [
                'id'    => '35',
                'title' => 'category_delete',
            ],
            [
                'id'    => '36',
                'title' => 'category_access',
            ],
            [
                'id'    => '37',
                'title' => 'reclamation_create',
            ],
            [
                'id'    => '38',
                'title' => 'reclamation_edit',
            ],
            [
                'id'    => '39',
                'title' => 'reclamation_show',
            ],
            [
                'id'    => '40',
                'title' => 'reclamation_delete',
            ],
            [
                'id'    => '41',
                'title' => 'reclamation_access',
            ],
            [
                'id'    => '42',
                'title' => 'comment_create',
            ],
            [
                'id'    => '43',
                'title' => 'comment_edit',
            ],
            [
                'id'    => '44',
                'title' => 'comment_show',
            ],
            [
                'id'    => '45',
                'title' => 'comment_delete',
            ],
            [
                'id'    => '46',
                'title' => 'comment_access',
            ],
            [
                'id'    => '47',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '48',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '49',
                'title' => 'dashboard_access',
            ],
            [
                'id'    => '50',
                'title' => 'reclamation_customer',
            ],
            [
                'id'    => '51',
                'title' => 'claim_management',
            ],
        ];

        Permission::insert($permissions);
    }
}
