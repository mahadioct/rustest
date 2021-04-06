<?php

namespace App\Http\Controllers\Position;

use App\Services\Position\PositionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    /**
     * @var PositionService
     */
    private $position;

    /**
     * PositionController constructor.
     * @param PositionService $position
     */
    public function __construct(PositionService $position)
    {
        $this->position = $position;
    }

    /**
     * Display all position
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $positions = $this->position->getPositionList();
        return view('back-end.position.index', compact('positions'));
    }

    /**
     * Display creat new position modal
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $departments = DB::table('departments')->orderBy('updated_at','desc')->get();
        return view('back-end.position.create',compact('departments'));
    }

    /**
     * Insert a new position
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function store(Request $request)
    {
        try {
            $this->position->storePosition($request);
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Edit a position
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $departments = DB::table('departments')->orderBy('updated_at','desc')->get();
        $position = $this->position->getPosition($id);
        return view('back-end.position.edit', compact('position','departments'));
    }

    /**
     * Update a position
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function update(Request $request)
    {
        try {
            $this->position->updatePosition($request);
            return redirect(route('position.index'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete a position
     * @param Request $request
     */
    public function destroy(Request $request){
        $this->position->destroyPosition($request);
    }
}
