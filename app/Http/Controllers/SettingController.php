<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    private $setting;
    public function __construct(Setting $setting) {
        $this->setting = $setting;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Setting::paginate(5);
        return view('admin.setting.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.setting.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddSettingRequest $request)
    {
        DB::table('settings')->insert([
           'config_value' => $request->input('config_value'),
           'config_key' => $request->input('config_key'),
            'type_setting' => $request->type,
        ]);
        return redirect()->route('setting.index');
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
        $data = $this->setting->find($id);
        return view('admin.setting.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->setting->find($id)->update([
           'config_value' => $request->input('config_value'),
           'config_key' => $request->input('config_key'),
        ]);
        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->setting->find($id)->delete();
        return redirect()->route('setting.index');
    }
}
