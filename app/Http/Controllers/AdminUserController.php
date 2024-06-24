<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddResquest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    private $user;
    private $roles;
    public function __construct(User $user, Role $roles) {
        $this->user = $user;
        $this->roles = $roles;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->user->orderBy('id', 'desc')->paginate(7);
        return view('admin.user.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roles->all();
        return view('admin.user.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserAddResquest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password)
            ]);

            $roleIds = $request->role_id;
//            dd($roleIds);
            $user->roles()->attach($roleIds);
            // n to n many to many relationship
            DB::commit();
            $hasRoleId2 = $user->roles->contains('id', 2);
            if($hasRoleId2) {
                return redirect()->to('login')->with('success', 'Register Success!');
            }
            else {
                return redirect()->route('user.index')->with('success', 'Insert Success');
            }
        } catch(\Exception $exception) {
            DB::rollBack();
            Log::error('Message: '. $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
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
        $data = $this->user->find($id);
        $roles = $this->roles->all();
        $rolesOfUser = $data->roles;
        return view('admin.user.edit', compact('data', 'roles', 'rolesOfUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserAddResquest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user = $this->user->find($id);
            $roleIds = $request->role_id;
            $user->roles()->sync($roleIds);
            // sync: check role nao co r thi thoi, chx co thi them moi
            DB::commit();
            return redirect()->route('user.index')->with('success', 'Update Success');
        } catch(\Exception $exception) {
            DB::rollBack();
            Log::error('Message: '. $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->user->find($id)->delete();
        $check = DB::table('role_user')->where('user_id', $id)->exists();;
        if(!$check) {
            $this->user->find($id)->delete();
            return redirect()->route('role.index')->with('success', 'Delete success');
        }
        return redirect()->route('user.index')->with('success', 'Delete Success');
    }
}
