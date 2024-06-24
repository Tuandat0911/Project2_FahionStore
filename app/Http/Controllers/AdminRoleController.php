<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoleController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->role->orderBy('id', 'desc')->paginate(7);
        return view('admin.role.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = $this->role->create([
           'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        $role->permissions()->attach($request->permission_id);

        return redirect()->route('role.index')->with('success', 'Insert success');
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
    public function edit(string $id)
    {
        $data = $this->role->find($id);
        $permissions = $this->permission->where('parent_id', 0)->get();
        $permissionChecked = $data->permissions;
        return view('admin.role.edit', compact('data', 'permissions', 'permissionChecked'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->role->find($id)->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        $role = $this->role->find($id);
        $role->permissions()->sync($request->permission_id);

        return redirect()->route('role.index')->with('success', 'Update success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = DB::table('role_user')->where('role_id', $id)->exists();
        if(!$check) {
            $this->role->find($id)->delete();
            return redirect()->route('role.index')->with('success', 'Delete success');
        }
        return redirect()->route('role.index')->with('error', 'Delete error');
    }
}
