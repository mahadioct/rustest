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
}
