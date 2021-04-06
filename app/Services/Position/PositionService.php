<?php

namespace App\Services\Position;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class PositionService
 * @package App\Services\Position
 */
class PositionService
{
    /**
     * Query for get all position for display in Datatable
     * @return \Illuminate\Support\Collection
     */
    public function getPositionList(): \Illuminate\Support\Collection
    {
        return DB::table('positions')
            ->leftJoin('departments', 'positions.department_id', '=', 'departments.id')
            ->select('positions.*', 'departments.name as department_name')
            ->orderBy('updated_at', 'desc')->get();
    }

    /**
     * Query for insert a new position
     * @param $data
     */
    public function storePosition($data)
    {
        DB::table('positions')->insert([
            'department_id' => $data->department_id,
            'name' => $data->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    /**
     * Query for get a single position for edit
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getPosition($id)
    {
        return DB::table('positions')->where('id', $id)->first();
    }

    /**
     * Query for update position
     * @param $data
     */
    public function updatePosition($data)
    {
        DB::table('positions')
            ->where('id', $data->id)
            ->update([
                'department_id' => $data->department_id,
                'name' => $data->name,
                'updated_at' => Carbon::now()
            ]);
    }

    /**
     * Query for destroy position
     * @param $data
     */
    public function destroyPosition($data)
    {
        DB::table('positions')->where('id', $data->id)->delete();
    }
}
