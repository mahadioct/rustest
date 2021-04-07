<?php

namespace App\Http\Controllers\Department;

use App\Services\Department\DepartmentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class DepartmentController
 * @package App\Http\Controllers\Department
 */
class DepartmentController extends Controller
{
    /**
     * @var DepartmentService
     */
    private $department;

    /**
     * DepartmentController constructor.
     * @param DepartmentService $department
     */
    public function __construct(DepartmentService $department)
    {
        $this->department = $department;
        $this->middleware('auth');
    }

    /**
     * Display all Department
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $departments = $this->department->getDepartmentList();
        return view('back-end.department.index', compact('departments'));
    }

    /**
     * Display creat new department modal
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('back-end.department.create');
    }

    /**
     * Insert a new department
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function store(Request $request)
    {
        try {
            $this->department->storeDepartment($request);
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Edit a department
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $department = $this->department->getDepartment($id);
        return view('back-end.department.edit', compact('department'));
    }

    /**
     * Update a department
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function update(Request $request)
    {
        try {
            $this->department->updateDepartment($request);
            return redirect(route('department.index'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete a department
     * @param Request $request
     */
    public function destroy(Request $request){
        $this->department->destroyDepartment($request);
    }
}
