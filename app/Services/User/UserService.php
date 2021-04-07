<?php

namespace App\Services\User;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class UserService
 * @package App\Services\User\UserService
 */
class UserService
{
    /**
     * Query for get all user for display in Datatable
     * @return array
     */
    public function getUserList(): array
    {
        $user_lists = DB::table('users')
            ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
            ->select('users.*', 'positions.name as position_name')
            ->orderBy('updated_at', 'desc')
            ->get();
        $user_array = [];
        foreach ($user_lists as $item) {
            $departments = DB::table('user_departments')
                ->leftJoin('departments', 'user_departments.department_id', '=', 'departments.id')
                ->select('departments.name as department_name')
                ->where('user_id', $item->id)
                ->get();
            $user_array[] = ([
                'id' => $item->id,
                'name' => $item->name,
                'email' => $item->email,
                'position_name' => $item->position_name,
                'department_name' => $departments,
                'updated_at' => $item->updated_at,
            ]);
        }
        return $user_array;
    }

    /**
     * Query for get department list
     * @return \Illuminate\Support\Collection
     */
    public function getDepartmentList(): \Illuminate\Support\Collection
    {
        return DB::table('departments')->orderBy('updated_at', 'desc')->get();
    }

    /**
     * Query for position list
     * @return \Illuminate\Support\Collection
     */
    public function getPositionList(): \Illuminate\Support\Collection
    {
        return DB::table('positions')->orderBy('updated_at', 'desc')->get();
    }

    /**
     * Query for Store new user
     * @param $data
     */
    public function storeUser($data)
    {
        DB::transaction(function () use ($data) {
            $id = DB::table('users')
                ->insertGetId([
                    'name' => $data->name,
                    'email' => $data->email,
                    'password' => Hash::make($data->password),
                    'position_id' => $data->position_id,
                ]);
            foreach ($data->department_id as $item) {
                DB::table('user_departments')
                    ->insert([
                        'user_id' => $id,
                        'department_id' => $item
                    ]);
            }
        });
    }

    /**
     * Query for get a user for edit
     * @return array
     */
    public function getUser($id): array
    {
        $user = DB::table('users')
            ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
            ->select('users.*', 'positions.id as position_id', 'positions.name as position_name')
            ->where('users.id', $id)
            ->first();
        $user_array = null;
        if ($user != null) {
            $departments = DB::table('user_departments')
                ->leftJoin('departments', 'user_departments.department_id', '=', 'departments.id')
                ->select('departments.id as department_id', 'departments.name as department_name')
                ->where('user_id', $id)
                ->get();
            $user_array = ([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'profile_photo' => $user->profile_photo,
                'position_id' => $user->position_id,
                'position_name' => $user->position_name,
                'department_id' => $departments,
                'updated_at' => $user->updated_at,
            ]);
        }
        return $user_array;
    }

    /**
     * Query for update a user
     * @return
     */
    public function updateUser($data)
    {
        DB::transaction(function () use ($data) {
            DB::table('users')
                ->where('id', $data->id)
                ->update([
                    'name' => $data->name,
                    'email' => $data->email,
                    'position_id' => $data->position_id,
                ]);
            DB::table('user_departments')
                ->where('user_id', $data->id)->delete();
            foreach ($data->department_id as $item) {
                DB::table('user_departments')
                    ->insert([
                        'user_id' => $data->id,
                        'department_id' => $item
                    ]);
            }
        });
    }

    /**
     * Query for destroy user
     * @param $data
     */
    public function destroyUser($data)
    {
        DB::transaction(function () use ($data) {
            DB::table('users')->where('id', $data->id)->delete();
            DB::table('user_departments')->where('user_id', $data->id)->delete();
        });
    }

    /**
     * Query for Update profile image url
     * @param $id
     * @param $url
     */
    public function uploadProfilePhotoUrl($id, $url)
    {
        DB::table('users')->where('id', $id)->update([
            'profile_photo' => $url
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Role[]
     */
    public function getAllRole()
    {
        return Role::all();
    }

    public function getAssignedRoles($id): \Illuminate\Support\Collection
    {
        return DB::table('model_has_roles')->where('model_id', $id)->get();
    }

    public function updateAssignRole($data)
    {
        $permission_data = DB::table('role_has_permissions')->whereIn('role_id', $data->role_id)->get();
        $permissions = [];
        foreach ($permission_data as $items) {
            $permissions[] = $items->permission_id;
        }

        $user = User::findOrFail($data->id);
        $user->syncRoles($data->role_id);
        $user->syncPermissions($permissions);
    }
}
