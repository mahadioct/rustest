<?php

namespace App\Http\Controllers\Department;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index(){
        return view('back-end.department.index');
    }

    public function create(){
        return view('back-end.department.create');
    }
}
