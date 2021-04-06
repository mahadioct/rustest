<?php

namespace App\Services\Department;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class CustomerService
 * @package App\Services\Customer
 */
class DepartmentService
{
    public function getDepartmentList(): \Illuminate\Support\Collection
    {
        return DB::table('departments')->orderBy('updated_at', 'desc')->get();
    }

    public function storeDepartment($data)
    {
        DB::table('departments')->insert([
            'name' => $data->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    public function getDepartment($id)
    {
        return DB::table('departments')->where('id', $id)->first();
    }

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

    public function destroyDepartment($data)
    {
        DB::table('departments')->where('id', $data->id)->delete();
    }
}
