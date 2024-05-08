<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('roles.index')) {
            abort(403, 'Sorry !! You are Unauthorized to view any roles !');
        }

        $roles = Role::all();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('roles.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any roles !');
        }

        $permission = Permission::all();
        return view('roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('roles.store')) {
            abort(403, 'Sorry !! You are Unauthorized to view any roles !');
        }

        $validated = $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ]);

        $role = Role::create(['name'=>$validated['name']]);
        $permission = Permission::whereIn('id',$validated['permissions'])->get(['id'])->pluck('id');
        $role->syncPermissions($permission);

        return redirect()->route('roles.index')->with('success','Roles Save');
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
    public function edit(Role $role)
    {
        if (is_null($this->user) || !$this->user->can('roles.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any roles !');
        }

        $permission = Permission::all();
        return view('roles.edit',compact('role','permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if (is_null($this->user) || !$this->user->can('roles.update')) {
            abort(403, 'Sorry !! You are Unauthorized to view any roles !');
        }

         $validated = $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ]);

        $role->update(['name'=>$validated['name']]);
        $permission = Permission::whereIn('id',$validated['permissions'])->get(['id'])->pluck('id');
        $role->syncPermissions($permission);

        return redirect()->route('roles.index')->with('success','Roles Save');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
