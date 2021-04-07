<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Services\Role\RoleService;
use Illuminate\Http\Request;

/**
 * Class RoleController
 * @package App\Http\Controllers\Role
 */
class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * RoleController constructor.
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
        $this->middleware('auth');
    }

    /**
     * Display all role with their permission
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = $this->roleService->getAllRole();
        return view('back-end.role.index', compact('roles'));
    }

    /**
     * Display create new role form
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('back-end.role.create');
    }

    /**
     * Store new role
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function store(Request $request)
    {
        try {
            $this->roleService->createNewRole($request);
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display assign permission role form
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function assignPermission($id)
    {
        $role = $this->roleService->getRole($id);
        $assigned_permissions = $this->roleService->getAssignedPermissions($id);
        $permissions = $this->roleService->getAllPermissions();
        return view('back-end.role.assign-permission', compact('role', 'permissions', 'assigned_permissions'));
    }

    /**
     * Assign permission to a role
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function assignPermissionUpdate(Request $request)
    {
        try {
            $this->roleService->assignPermissionToRole($request);
            return redirect(route('role.index'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Edit a role
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $role = $this->roleService->getRole($id);
        return view('back-end.role.edit', compact('role'));
    }

    /**
     * Update a role
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function update(Request $request)
    {
        try {
            $this->roleService->updateRole($request);
            return redirect(route('role.index'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete a role
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $this->roleService->deleteRole($request);
    }
}
