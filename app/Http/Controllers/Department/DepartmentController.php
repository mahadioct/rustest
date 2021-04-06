<?php

namespace App\Http\Controllers\Department;

use App\Services\Department\DepartmentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    private $department;

    public function __construct(DepartmentService $department)
    {
        $this->department = $department;
    }

    public function index()
    {
        $departments = $this->department->getDepartmentList();
        return view('back-end.department.index', compact('departments'));
    }

    public function create()
    {
        return view('back-end.department.create');
    }

    public function store(Request $request)
    {
        try {
            $this->department->storeDepartment($request);
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        $department = $this->department->getDepartment($id);
        return view('back-end.department.edit', compact('department'));
    }

    public function update(Request $request)
    {
        try {
            $this->department->updateDepartment($request);
            return redirect(route('department.index'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(Request $request){
        $this->department->destroyDepartment($request);
    }
}
