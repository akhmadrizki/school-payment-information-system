<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffProfileController extends Controller
{
    public function index()
    {
        $getUserActive = Auth::user()->id;
        $master = User::where('id', $getUserActive)
            ->with('admin', 'role')
            ->first();

        return view('pages.dashboard.admin.profile', compact('master', 'getUserActive'));
    }

    public function edit($id)
    {
        $getUser = User::with('admin')->findOrFail($id);
        return view('pages.dashboard.admin.edit-profile', compact('getUser'));
    }

    public function update(Request $request, $id)
    {
        try {
            $getUserActive = Auth::user()->id;
            $getUser = User::findOrFail($id);

            $this->validate(
                $request,
                [
                    'username' => 'required|regex:/^\S*$/u|min:4|max:20',
                    'email' => 'required|email'
                ],
                ['username.regex' => 'Username tidak boleh berisikan spasi'],
            );

            $fieldsMaster = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ];
            $getUser->update($fieldsMaster);

            if ($getUser->role_id == 2) {

                $this->validate(
                    $request,
                    ['contact' => 'required|regex:/^([0-9\s\(\)]*)$/|min:10|max:15'],
                    ['contact.regex' => 'Nomor tidak sesuai'],
                );

                $admin = Admin::where('user_id', $getUserActive)->first();

                $fieldsAdmin = [
                    'address' => $request->address,
                    'contact' => $request->contact,
                ];
                $admin->update($fieldsAdmin);
            }

            return redirect()->route('admin.dashboard')->with([
                'message' => 'Data berhasil diubah',
                'status' => 'success',
            ]);
        } catch (Exception $error) {
            return redirect()->route('staff.profile')->with('message', $error->getMessage());
        }
    }

    public function password($id)
    {
        $getUser = User::findOrFail($id);
        return view('pages.dashboard.admin.change-password', compact('getUser'));
    }

    public function updatePassword(Request $request, $id)
    {
        try {
            $getUser = User::findOrFail($id);
            $this->validate(
                $request,
                ['password' => 'required|string|confirmed|min:4'],
                ['password.confirmed' => 'Password tidak sama']
            );

            $field = [
                'password' => Hash::make($request->password),
            ];
            $getUser->update($field);
            return redirect()->route('admin.dashboard')->with([
                'message' => 'Password berhasil diubah',
                'status' => 'success',
            ]);
        } catch (Exception $error) {
            return redirect()->route('staff.profile.password', $getUser->id)->with('message', $error->getMessage());
        }
    }
}
