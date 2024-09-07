<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\StoreRequest;
use App\Http\Requests\Admin\Roles\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::latest()->paginate(3);
        return view('admin.dashboard.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::select('type')->distinct()->get();
        return view('admin.dashboard.roles.create',compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $request->validated();
        $data= $request->all();
        $data['guard_name'] = 'admin';
        $role = Role::create($data);
        $permissions = $request->permissions_id;
        $role->givePermissionTo($permissions);
        return redirect()->route('roles.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::select('type')->distinct()->get();
        return view('admin.dashboard.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Role $role)
    {
        $request->validated();
        if($role->name!=$request->name)
        {
            $data['name']=$request->name;
        }else{
            $data['name']=$role->name;
        }
        $role->update($request->all());
        $permissions = $request->permissions_id;
        if(isset($permissions))
        {
            DB::table('role_has_permissions')->where('role_id' , $role->id)->delete();
            $role->givePermissionTo($permissions);
        }
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index');


    }
}