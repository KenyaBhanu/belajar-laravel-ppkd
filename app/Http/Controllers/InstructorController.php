<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor::with('major')->orderByDesc('id')->get();
        // return $instructors;
        // dd($instructors);
        $title = "Instructor Management";
        return view('instructor.index', compact('instructors', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Instructor";
        $majors = Major::get();
        return view('instructor.create', compact('title', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'major_id' => 'required',
            'name' => 'required',
            'phone' => 'nullable'
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            Instructor::create([
                'name' => $request->name,
                'user_id' => $user->id,
                'major_id' => $request->major_id,
                'phone' => $request->phone
            ]);
            DB::commit();
            Alert::success('Success', 'Created Instructor succesfully');
            // toast('Success', 'Congrats', 'top-right');
            return redirect()->to('instructor');

        } catch (\Throwable $th) {
            DB::rollBack();
            // return $th->getMessage();
            Alert::error('Fail!', $th->getMessage());
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
        $title = "Edit Instructor";
        $edit = Instructor::find($id);
        $majors = Major::get();
        return view('instructor.edit', compact('title', 'edit', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructor $instructor)
    {
        DB::beginTransaction();
        try {
            $dataUser = [
                'name' => $request->name,
                'email' => $request->email
            ];
            $user = $instructor->user;
            if ($request->filled('password')) {
                $dataUser['password'] = $request->password;
            }


            $user->update($dataUser);

            $data = [
                'major_id' => $request->major_id,
                'name' => $request->name,
                'phone' => $request->phone
            ];
            $instructor->update($data);
            DB::commit();
            Alert::success('Success!', 'Edited Instructor succesfully');
            return redirect()->to('instructor');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Fail!', $th->getMessage());
            return back()->withInput();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $instructor = Instructor::find($id);
            $instructor->delete();
            Alert::success('Success!', 'Deleted Instructor succesfully');
            return redirect()->to('instructor');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Fail!', $th->getMessage());
            return back();
        }
    }
}
