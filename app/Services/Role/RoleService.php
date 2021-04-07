<?php

namespace App\Services\Role;


use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

/**
 * Class RoleService
 * @package App\Services\Role\RoleService
 */
class RoleService
{
    /**
     * Query for get all role
     * @return \Illuminate\Support\Collection
     */
    public function getAllRole(): \Illuminate\Support\Collection
    {
        return Role::with('permissions')->get();
    }

    /**
     * Query for create a new role
     * @param $data
     */
    public function createNewRole($data)
    {
        Role::create(['name' => $data->name]);
    }

    /**
     * Query for get a role
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getRole($id)
    {
        return DB::table('roles')->where('id', $id)->first();
    }

    /**
     * Query for get assigned permission for a particular role
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getAssignedPermissions($id): \Illuminate\Support\Collection
    {
        return DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)
            ->leftJoin('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->select('permissions.*')
            ->get();
    }

    /**
     * Query for get all permission
     * @return \Illuminate\Support\Collection
     */
    public function getAllPermissions(): \Illuminate\Support\Collection
    {
        return DB::table('permissions')->orderBy('updated_at', 'desc')->get();
    }

    /**
     * Query for assign permission to role
     * @param $data
     */
    public function assignPermissionToRole($data)
    {
        $role = Role::findById($data->id);
        $role->syncPermissions($data->permission);
    }

    /**
     * Query for update role
     * @param $data
     */
    public function updateRole($data)
    {
        DB::table('roles')->where('id', $data->id)->update([
            'name' => $data->name
        ]);
    }

    /**
     * Query for delete role
     * @param $data
     */
    public function deleteRole($data)
    {
        DB::transaction(function () use ($data) {
            DB::table('roles')->where('id', $data->id)->delete();
            DB::table('role_has_permissions')->where('role_id', $data->id)->delete();
        });
    }
}
