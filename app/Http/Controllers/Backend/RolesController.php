<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('backend.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $permissions = Permission::all();
        $group_name = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();

        return view('backend.pages.roles.create', compact('permissions', 'group_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            ['name' => 'required|max:100|unique:roles'], ['name.required' => 'Please Give a Role name']
        );
        $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);
        if (! empty($request->permissions)) {
            $role->syncPermissions($request->permissions);
        }
        $roles = Role::all();

        return view('backend.pages.roles.index', compact('roles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $group_name = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();

        return view('backend.pages.roles.edit', compact('role', 'permissions', 'group_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //        dd("called");
        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,'.$id,
        ], [
            'name.requried' => 'Please give a role name',
        ]);

        $role = Role::findById($id);
        $permissions = $request->input('permissions');

        if (! empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        session()->flash('success', 'Role has been updated !!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Role::find($id);
        if (! is_null($user)) {
            $user->delete();
        }

        session()->flash('success', 'Role has been deleted !!');

        return back();
    }
}
