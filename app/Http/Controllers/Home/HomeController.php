<?php

namespace App\Http\Controllers\Home;

use App\Services\User\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * HomeController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = $this->userService->getUser(Auth::user()->id);
        return view('back-end.home.home', compact('user'));
    }
}
