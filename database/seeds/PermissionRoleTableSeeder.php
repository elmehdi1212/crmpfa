<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions =Permission::where('id', '!=', 50)->get();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $all_permissions=Permission::All();
        $responsable_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0,7) !='status_' && substr($permission->title, 0,9) !='priority_'  && substr($permission->title, 0,9) !='category_' && substr($permission->title, 0,8) !='comment_' && substr($permission->title,0,6) !='audit_';
        });
        Role::findOrFail(3)->permissions()->sync($responsable_permissions);
        $customer_permissions = $all_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0,7) !='status_' && substr($permission->title, 0,9) !='priority_'  && substr($permission->title, 0,9) !='category_' && substr($permission->title, 0,8) !='comment_' && substr($permission->title,0,6) !='audit_' && substr($permission->title,0,6) !='claim_';
        });
        Role::findOrFail(2)->permissions()->sync($customer_permissions);
    }
}
