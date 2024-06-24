<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class AdminPermissions extends Controller
{
    public function createPermissions() {
        return view('admin.permission.add');
    }

    public function store(Request $request)
    {
        $permission = Permission::create([
           'name' => $request->module_parent,
           'display_name' => $request->module_parent,
            'parent_id' => 0
        ]);

        foreach($request->module_child as $value) {
            Permission::create([
                'name' => $request->module_parent . '-'. $value,
                'display_name' => $request->module_parent . '-'. $value,
                'parent_id' => $permission->id,
                'key_code' => $request->module_parent . '_' . $value
            ]);
        }
    }
}
