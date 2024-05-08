<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdatedUserRequest;

class UserController extends Controller
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
        if (is_null($this->user) || !$this->user->can('users.index')) {
            abort(403, 'Sorry !! You are Unauthorized to view any permission !');
        }

        $user = User::all();
        return view('users.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('users.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any permission !');
        }

        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('users.store')) {
            abort(403, 'Sorry !! You are Unauthorized to view any permission !');
        }
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'roles' => 'required',
        ]);

        $user = User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>bcrypt($validated['password'])
        ]);
        $role = Role::whereIn('id',$validated['roles'])->get(['id'])->pluck('id');
        $user->assignRole($role);

        return redirect()->route('users.index')->with('success','Users Save');
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
    public function edit(User $user)
    {
        if (is_null($this->user) || !$this->user->can('users.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any permission !');
        }
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (is_null($this->user) || !$this->user->can('users.update')) {
            abort(403, 'Sorry !! You are Unauthorized to view any permission !');
        }

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'roles' => 'required'
        ]);

        $user->update([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>$validated['password'] ? bcrypt($validated['password']) : $user->password,
        ]);
        $roles = Role::whereIn('name',$validated['roles'])->get(['id'])->pluck('id');
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success','User Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
