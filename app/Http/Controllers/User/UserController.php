<?php

namespace App\Http\Controllers\User;

use App\Services\User\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class UserController
 * @package App\Http\Controllers\User
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth');
    }

    /**
     * Display user on index page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = $this->userService->getUserList();
        return view('back-end.user.index', compact('users'));
    }

    /**
     * Create new user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $departments = $this->userService->getDepartmentList();
        $positions = $this->userService->getPositionList();
        return view('back-end.user.create', compact('departments', 'positions'));
    }

    /**
     * Store new user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->userService->storeUser($request);
        return redirect()->back();
    }

    /**
     * Edit User
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $departments = $this->userService->getDepartmentList();
        $positions = $this->userService->getPositionList();
        $user = $this->userService->getUser($id);
        return view('back-end.user.edit', compact('departments', 'positions', 'user'));
    }

    /**
     * Update User
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function update(Request $request)
    {
        try {
            $this->userService->updateUser($request);
            return redirect(route('user.index'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete a user
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $this->userService->destroyUser($request);
    }

    /**
     * Display modal for upload profile photo
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function uploadPhoto(Request $request)
    {
        $id = $request->id;
        return view('back-end.user.upload-photo', compact('id'));
    }

    /**
     * Upload profile photo and save url
     * @param Request $request
     * @return string
     */
    public function updateProfilePhoto(Request $request): string
    {
        try {
            if ($request->has('photo')) {
                $image = $request->file('photo');
                $image_ext = $image->getClientOriginalExtension();
                $name = uniqid() . '.' . $image_ext;
                $destinationPath = public_path('/user/profile/');
                $image->move($destinationPath, $name);
                $image_url = url('') . '/user/profile/' . $name;
                $this->userService->uploadProfilePhotoUrl($request->id, $image_url);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function assignRole($id)
    {
        $user = $this->userService->getUser($id);
        $assignedRoles = $this->userService->getAssignedRoles($id);
        $roles = $this->userService->getAllRole();
        return view('back-end.user.assign-role', compact('user', 'roles', 'assignedRoles'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function assignRoleUpdate(Request $request)
    {
        $this->userService->updateAssignRole($request);
        return redirect(route('user.index'));
    }
}
