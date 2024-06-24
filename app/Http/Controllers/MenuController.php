<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('menus')->where('deleted_at', Null)->paginate(5);
        return view('admin.menu.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $recursive = new MenuRecusive();
        $htmloption = $recursive->menuRecusiveAdd();
        return  view('admin.menu.add', compact('htmloption', 'htmloption'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('menus')->insert([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('menu.index')->with('success', 'insert successfully');
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
        $recursive = new MenuRecusive();
        $menu = DB::table('menus')->find($id);
        $htmloption = $recursive->menuRecusiveEdit($menu->parent_id);

        return view('admin.menu.edit', compact('menu', 'htmloption'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('menus')->where('id', $id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('menu.index')->with('success', 'update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = new Menu();
        $menu->where('id', $id)->delete();
        return redirect()->route('menu.index')->with('success', 'Delete successfully');
    }
}
