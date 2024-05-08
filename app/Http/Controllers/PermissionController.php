<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
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
    	if (is_null($this->user) || !$this->user->can('permission.index')) {
            abort(403, 'Sorry !! You are Unauthorized to view any permission !');
        }

        $permission = Permission::all();
        return view('permission.index',compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    	if (is_null($this->user) || !$this->user->can('permission.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any permission !');
        }

        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    	
    	if (is_null($this->user) || !$this->user->can('permission.store')) {
            abort(403, 'Sorry !! You are Unauthorized to view any permission !');
        }

 		$request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();
        return redirect()->route('permission.index')->with('success','Permission Save');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
    	if (is_null($this->user) || !$this->user->can('permission.show')) {
            abort(403, 'Sorry !! You are Unauthorized to view any permission !');
        }

        return view('permission.show',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
    	if (is_null($this->user) || !$this->user->can('permission.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any permission !');
        }

        return view('permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    	if (is_null($this->user) || !$this->user->can('permission.update')) {
            abort(403, 'Sorry !! You are Unauthorized to view any permission !');
        }

    	$this->validate($request,[
            'name' =>'required'
        ]);
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();

    	
        return redirect()->route('permission.index')->with('success','Permission Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    	if (is_null($this->user) || !$this->user->can('permission.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to view any permission !');
        }

    	$permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permission.index')->with('success','Permission Deleted');

    }
}
