<?php

namespace App\Http\Controllers\User;

use App\Services\User\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * DepartmentController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getUserList();
        return view('back-end.user.index', compact('users'));
    }

    public function edit($id)
    {
        $departments = $this->userService->getDepartmentList();
        $positions = $this->userService->getPositionList();
        $user = $this->userService->getUser($id);
        return view('back-end.user.edit', compact('departments', 'positions', 'user'));
    }

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
