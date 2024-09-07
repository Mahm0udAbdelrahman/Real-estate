<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $getrole = DB::table('model_has_roles')->where('model_id', Auth::guard('admin')->user()->id)
            ->where('model_type', 'App\Models\Admin')->first();
        $role = Role::where('id', $getrole->role_id)->first();
        if ($role->name == "Super Admin" || $role->name == "Admin") {
            return $next($request);
        } else {
            // toastr()->error('Oops! You have not admin access!', 'Error', ['timeOut' => 5000]);
            Alert::error('Error', 'Oops! You have not admin access!');

            return redirect()->route("admin.login_page");
        }




    }
}
