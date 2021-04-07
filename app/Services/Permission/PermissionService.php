<?php

namespace App\Services\Permission;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class PermissionService
 * @package App\Services\Permission\PermissionService
 */
class PermissionService
{
    /**
     * Query for display all permission to permission index page
     * @return \Illuminate\Support\Collection
     */
    public function getAllPermission(): \Illuminate\Support\Collection
    {
        return DB::table('permissions')->orderBy('created_at', 'desc')->get();
    }

    /**
     * Query for create a permission
     * @param $data
     */
    public function createPermission($data)
    {
        Permission::create(['name' => $data->name]);
    }

    /**
     * Query for get a permission
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getPermission($id)
    {
        return DB::table('permissions')->where('id', $id)->first();
    }

    /**
     * Query for update permission
     * @param $data
     */
    public function updatePermission($data)
    {
        DB::table('permissions')
            ->where('id', $data->id)
            ->update([
                'name' => $data->name
            ]);
    }

    /**
     * Query for Remove a permission from role and delete it
     * @param $data
     */
    public function deletePermission($data)
    {
        $role = new Role();
        $role->revokePermissionTo($data->id);
        DB::table('permissions')->where('id', $data->id)->delete();
    }
}
