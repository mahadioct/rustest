<?php

namespace App\Http\Controllers\Permission;

use App\Services\Permission\PermissionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class PermissionController
 * @package App\Http\Controllers\Permission
 */
class PermissionController extends Controller
{
    /**
     * @var PermissionService
     */
    private $permission;

    /**
     * PermissionController constructor.
     * @param PermissionService $permission
     */
    public function __construct(PermissionService $permission)
    {
        $this->permission = $permission;
        $this->middleware('auth');
    }

    /**
     * Display All Permission
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $permissions = $this->permission->getAllPermission();
        return view('back-end.permission.index', compact('permissions'));
    }

    /**
     * Create a permission
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('back-end.permission.create');
    }

    /**
     * Store a permission
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function store(Request $request)
    {
        try {
            $this->permission->createPermission($request);
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Edit a permission
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $permission = $this->permission->getPermission($id);
        return view('back-end.permission.edit', compact('permission'));
    }

    /**
     * Update a permission
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function update(Request $request)
    {
        try {
            $this->permission->updatePermission($request);
            return redirect(route('permission.index'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete a permission
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $this->permission->deletePermission($request);
    }
}
