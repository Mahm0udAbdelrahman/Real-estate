<?php

namespace App\Http\Controllers\Member;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
       $packages =  Package::all();

       return view('members.dashboard.plan',compact('packages'));
    }

    public function show(Package $plan, Request $request)
    {
        $intent = Auth::guard('member')->user()->createSetupIntent();

        return view("members.dashboard.subscription", compact("plan", "intent"));
    }

    public function subscription(Request $request)
    {
         $plan = Package::find($request->price);

        // $subscription = $request->user()->newSubscription($request->name, $plan->price)
        //                 ->create($request->token);

        return view("members.dashboard.subscription_success");
    }
}