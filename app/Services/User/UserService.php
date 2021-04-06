<?php

namespace App\Services\User;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 * @package App\Services\UserService
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

    public function getDepartmentList(): \Illuminate\Support\Collection
    {
        return DB::table('departments')->orderBy('updated_at', 'desc')->get();
    }

    public function getPositionList(): \Illuminate\Support\Collection
    {
        return DB::table('positions')->orderBy('updated_at', 'desc')->get();
    }

    public function getUser($id): array
    {
        $user = DB::table('users')
            ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
            ->select('users.*', 'positions.id as position_id')
            ->where('users.id', $id)
            ->first();
        $user_array = null;
        if ($user != null) {
            $departments = DB::table('user_departments')
                ->leftJoin('departments', 'user_departments.department_id', '=', 'departments.id')
                ->select('departments.id as department_id')
                ->where('user_id', $id)
                ->get();
            $user_array = ([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'position_id' => $user->position_id,
                'department_id' => $departments,
                'updated_at' => $user->updated_at,
            ]);
        }
        return $user_array;
    }

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
}
