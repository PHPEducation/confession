<?php

namespace App\Http\Controllers\admin;

use App\Models\Permission;
use App\Repositories\Contracts\PermissionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    protected $permission;

    public function __construct(PermissionRepository $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = $this->permission->getAll();

        if ($request->ajax()) {
            return view('admin.permission.pagination_data_permission', ['permissions' => $permissions])->render();
        }

        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->permission->store($request->all());

        return back()->with('success', trans('message.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = $this->permission->show($id);

        return view('admin.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->permission->find($id);

        return view('admin.permission.edit', compact('permission'));
    }

    public function updateAll(Request $request, $id)
    {
        $permission = $this->permission->find($id);
        $permission->update($request->all());

        return back()->with('success', trans('message.success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $test = Permission::findOrFail($id);
        $columnName = Input::get('name');
        $columnValue = Input::get('value');
        if (Input::has('name')) {
            $test = Permission::select()
                ->where('id', '=', $id)
                ->update([$columnName => $columnValue]);

            return response()->json(['code' => 200], 200);
        }

        return response()->json(['error' => 400, 'message' => trans('message.not_enought_params')], 400);
    }

    public function bulkUpdate(Request $request)
    {
        if (Input::has('ids_to_edit') && Input::has('bulk_name') && Input::has('bulk_value')) {
            $ids = Input::get('ids_to_edit');
            $bulkName = Input::get('bulk_name');
            $bulkValue = Input::get('bulk_value');
            foreach ($ids as $id) {
                $test = Permission::select()->where('id', '=', $id)->update([$bulkName => $bulkValue]);
            }
            $message = trans('message.done');
        } else {
            $message = trans('message.error');

            return Redirect::back()->withErrors(['message' => $message])->withInput();
        }

        return Redirect::back()->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->permission->delete($id);

        return back()->with('success', trans('message.success'));
    }
}
