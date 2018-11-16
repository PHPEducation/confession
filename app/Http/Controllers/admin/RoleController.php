<?php

namespace App\Http\Controllers\admin;

use App\Models\Permission;
use App\Models\Role;
use App\Repositories\Contracts\PermissionRepository;
use App\Repositories\Contracts\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    protected $role;
    protected $permission;

    public function __construct(RoleRepository $role, PermissionRepository $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->getAll();

        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permission->getAllNotPagination()->pluck('name', 'id');

        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();
        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('roles.index')->with('success', trans('message.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = $this->permission->getAll()->pluck('name', 'id');
        $rolePermissions = $role->perms()->pluck('id', 'id')->toArray();

        return view('admin.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function updateAll(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        DB::table('permission_role')->where('role_id', $id)->delete();

        foreach ($request->permission as $key => $value) {
            $role->attachPermission($value);
        }

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
        $test = Role::findOrFail($id);
        $columnName = Input::get('name');
        $columnValue = Input::get('value');
        if (Input::has('name')) {
            $test = Role::select()
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
                $test = Role::select()->where('id', '=', $id)->update([$bulkName => $bulkValue]);
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
        $this->role->delete($id);

        return back()->with('success', trans('message.success'));
    }
}
