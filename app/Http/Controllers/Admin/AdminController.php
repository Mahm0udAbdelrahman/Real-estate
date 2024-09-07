<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Admins\StoreRequest;
use App\Http\Requests\Admin\Admins\UpdateRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::where('id', '!=', Auth::guard('admin')->user()->id)->latest()->get();
        return view('admin.dashboard.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admins = Admin::where('id', '!=', Auth::guard('admin')->user()->id)->with('roles')->get();
        $roles = Role::get();
        return view('admin.dashboard.admins.create',compact('admins','roles'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $request->validated();
        $data = $request->all();
        if(isset($request->image))
        {
            $data['image']=$request->image;
        }
        $data['password']= Hash::make($request->password);
        $admins = Admin::create($data);
        $admins->assignRole($request->role);
        return redirect()->route('admins.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $admin['roles'] = DB::table('model_has_roles')->where('model_id', $admin->id)
            ->where('model_type', 'App\Models\Admin')->select('role_id')->pluck('role_id');
        $roles = Role::get();
        return view('admin.dashboard.admins.edit',compact('admin','roles'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Admin $admin)
    {
       $data = $request->all();
       if(isset($request->image))
       {
        $data['image']=$request->image;
       }
       if(isset($request->password))
       {
        $data['password']= Hash::make($request->password);
       }
       $admin->update($data);
       if (isset($request->role)) {
        $admin->roles()->sync($request->role);
        }
        return redirect()->route('admins.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index');

    }
}