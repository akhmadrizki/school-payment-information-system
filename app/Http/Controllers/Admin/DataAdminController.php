<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Admin::with('user')->get();
        return view('pages.dashboard.admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $field = [
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'role_id'  => 2,
            'password' => Hash::make('admin123#'),
        ];
        $addAdmin = User::create($field);

        $fieldAdmin = [
            'address' => $request->address,
            'contact' => $request->contact,
            'user_id' => $addAdmin->id,
        ];
        Admin::create($fieldAdmin);

        return redirect()->route('admin.index')->with([
            'message' => 'Data admin berhasil ditambahkan',
            'status'  => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::with('user')->findOrFail($id);
        return view('pages.dashboard.admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $field = [
            'address' => $request->address,
            'contact' => $request->contact,
        ];
        $admin->update($field);

        $user = User::findOrFail($admin->user_id);
        $fieldUser = [
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
        ];
        $user->update($fieldUser);

        return redirect()->route('admin.index')->with([
            'message' => 'Data admin berhasil diubah',
            'status'  => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin   = Admin::findOrFail($id);
        $getUser = User::findOrFail($admin->user_id);
        $getUser->delete();
        return redirect()->route('admin.index')->with([
            'message' => 'Data admin berhasil dihapus',
            'status'  => 'success',
        ]);
    }
}
