<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class  CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('id', 'desc')->paginate(5);

        return view('admin.category.index')->with('categories', $category);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $recusive = new Recusive();
        $htmlOption = $recusive->CategoryRecusiveAdd();
        return view("admin.category.add", compact('htmlOption'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('categories')->insert([
           'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('categories.index')->with('success', "Insert Success!");
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
        $recusive = new Recusive;
        $category = DB::table('categories')->find($id);
        $htmlOption = $recusive->categoryRecusiveEdit($category->parent_id);
        return view("admin.category.edit", compact('category', 'htmlOption'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('categories')->where('id', $id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('categories.index')->with('success', "Update Success!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = new Category;
        $check = $category->where('parent_id', $id)->get();
        $bool = $check->contains('parent_id', $id) ? true:false;
        $productCheck = Product::where('category_id', $id)->exists();

        if($bool == false && !$productCheck) {
            $category->find($id)->delete();
            return redirect()->route('categories.index')->with('success', "Delete Success!");
        }
        return redirect()->route('categories.index')->with('error', "Delete Error!");
    }

    public function history() {
        $category = Category::onlyTrashed()->paginate(5);
        return view('admin.category.history')->with('categories', $category);
    }

    public function restore(string $id) {
        $category = Category::withTrashed()->find($id);

        if ($category && $category->trashed()) {
            $category->restore();
            return redirect()->route('categories.history')->with('success', 'Category restored successfully.');
        } else {
            return redirect()->route('categories.history')->with('error', 'Category not found or not trashed.');
        }
    }
}
