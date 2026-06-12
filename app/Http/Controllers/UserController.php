<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::orderBy('id','desc')->get();
        // $users = User::orderByDesc('id')->get();
        $users = User::with('role')->orderByDesc('id')->get();
        $title = "User Management";

        $deleteTitle = "Delete user!";
        $deleteText = "Are you sure you want to delete this user?";
        confirmDelete($deleteTitle, $deleteText);

        // baca docs, taro codes nya di dalam script di user/index

        return view('user.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New User";
        $roles = Role::all();
        return view('user.create', compact('title', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $user->roles()->sync($request->role_ids);
            DB::commit();
            Alert::success('Success!', 'Created user successfully!');
            return redirect()->to('user');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed!', $th->getMessage());
            return back()->withInput();
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
        $title = "Edit User";
        $edit = User::find($id);
        $roles = Role::get();
        // $edit = User::findOrFail($id);
        return view('user.edit', compact('title', 'edit', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email
            ];
            if (filled($request->password)) {
                $data['password'] = $request->password;
            }

            $user = User::findOrFail($id);
            $user->update($data);
            $user->roles()->sync($request->role_ids);
            DB::commit();
            return redirect()->to('user');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors($th->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        Alert::success('Success!', 'User deleted successfully!');
        return redirect()->to('user');
    }
}
