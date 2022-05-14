<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentProfileController extends Controller
{
    public function index()
    {
        $getUserActive = Auth::user()->id;
        $getUser = Student::where('user_id', $getUserActive)
            ->with('user', 'studyProgram', 'scholarship', 'grade')
            ->first();

        return view('pages.dashboard.student-session.profile', compact('getUser'));
    }

    public function edit($id)
    {
        $getUser = Student::with('user', 'studyProgram', 'scholarship', 'grade')->findOrFail($id);
        return view('pages.dashboard.student-session.edit-profile', compact('getUser'));
    }

    public function update(UpdateStudentRequest $request, $id)
    {
        try {
            $validated = $request->safe()->only(['name', 'email', 'whatsapp', 'whatsapp_parent']);
            $student = Student::findOrFail($id);

            if ($validated['whatsapp'] == $student->whatsapp) {
                $wa = $request->whatsapp;
            } else {
                $this->validate(
                    $request,
                    ['whatsapp' => 'required|unique:students,whatsapp'],
                    ['whatsapp.unique' => 'Nomor WhatsApp sudah terdaftar']
                );
                $wa = $request->whatsapp;
            }

            // Update to Student table
            $fields = [
                'whatsapp' => $wa,
                'whatsapp_parent' => $validated['whatsapp_parent'],
            ];
            $student->update($fields);

            // Update to User table
            $user = User::findOrFail($student->user_id);

            $fieldUser = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];
            $user->update($fieldUser);

            return redirect()->route('student.profile')->with([
                'message' => 'Data berhasil diubah',
                'status' => 'success',
            ]);
        } catch (Exception $error) {
            return redirect()->route('student.profile.edit', $student->id)->with('message', $error->getMessage());
        }
    }

    public function password($id)
    {
        $getUser = Student::with('user', 'studyProgram', 'scholarship', 'grade')->findOrFail($id);
        return view('pages.dashboard.student-session.change-password', compact('getUser'));
    }

    public function updatePassword(Request $request, $id)
    {
        try {
            $student = Student::findOrFail($id);
            $user = User::findOrFail($student->user_id);
            $this->validate(
                $request,
                ['password' => 'required|string|confirmed|min:4'],
                ['password.confirmed' => 'Password tidak sama']
            );

            $fieldUser = [
                'password' => Hash::make($request->password),
            ];
            $user->update($fieldUser);

            return redirect()->route('student.profile')->with([
                'message' => 'Password berhasil diubah',
                'status' => 'success',
            ]);
        } catch (Exception $error) {
            return redirect()->route('student.profile.password', $student->id)->with('message', $error->getMessage());
        }
    }
}
