<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        $title = "Menu management";
        return view('menu.index', compact('menus', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Menu";
        $roles = Role::all();
        $parents = Menu::where('parent_id', '=', null)->get();
        return view('menu.create', compact('title', 'roles', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'parent_id' => 'nullable|exists:menus,id',
            'name' => 'required|string|max:55',
            'icon' => 'nullable|string|max:55',
            'url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id'
        ]);

        $menu = Menu::create($validate);

        if($request->roles) {
            $menu->roles()->attach($request->roles);
        }

        Alert::success('Success!', 'Created menu successfully');
        return redirect()->to('menu');
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
        $title = "Edit Menu";
        $edit = Menu::find($id);
        $parents = Menu::where('parent_id', '=', null)->get();
        $roles = Role::all();
        $menuRoles = $edit->roles->pluck('id')->toArray();
        return view('menu.edit', compact('title', 'edit', 'roles', 'parents', 'menuRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $validate = $request->validate([
            'parent_id' => 'nullable|exists:menus,id',
            'name' => 'required|string|max:55',
            'icon' => 'nullable|string|max:55',
            'url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id'
        ]);

        $menu->update($validate);
        $menu->roles()->sync($request->roles);

        Alert::success('Success', 'Updated menu successfully.');
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        Alert::success('Success', 'Deleted menu successfully');
        return redirect()->to('menu');
    }
}
