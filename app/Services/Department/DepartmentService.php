<?php

namespace App\Services\Department;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class DepartmentService
 * @package App\Services\Department
 */
class DepartmentService
{
    /**
     * Query for get all department for display in Datatable
     * @return \Illuminate\Support\Collection
     */
    public function getDepartmentList(): \Illuminate\Support\Collection
    {
        return DB::table('departments')->orderBy('updated_at', 'desc')->get();
    }

    /**
     * Query for insert a new department
     * @param $data
     */
    public function storeDepartment($data)
    {
        DB::table('departments')->insert([
            'name' => $data->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    /**
     * Query for get a single department for edit
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getDepartment($id)
    {
        return DB::table('departments')->where('id', $id)->first();
    }

    /**
     * Query for update Department
     * @param $data
     */
    public function updateDepartment($data)
    {
        DB::table('departments')
            ->where('id', $data->id)
            ->update([
                'name' => $data->name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
    }

    /**
     * Query for destroy department
     * @param $data
     */
    public function destroyDepartment($data)
    {
        DB::table('departments')->where('id', $data->id)->delete();
    }
}
