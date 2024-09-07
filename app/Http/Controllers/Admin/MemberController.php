<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::latest()->get();

        return view('admin.dashboard.members.index',compact('members'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           return view('admin.dashboard.members.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string',
            'email'=> 'required|string',
            'birthday_date'=> 'required|string',
            'type'=> 'required|string',
            'phone'=> 'required|string',
        ]);


        $data = $request->except('password');
        $data['password']= Hash::make($request->password);
         Member::create($data);


        return redirect()->route('add_insurances.create');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('admin.dashboard.members.edit',compact('member'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name'=> 'required|string',
            'email'=> 'required|string',
            'birthday_date'=> 'required|string',
            'type'=> 'required|string',
            'phone'=> 'required|string',

        ]);


        $data = $request->except('password');
        if(isset($request->password))
       {
        $data['password']= Hash::make($request->password);
       }
        $member->update($data);
        return redirect()->route('members.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index');

    }

}