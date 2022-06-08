<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Grade;
use App\Models\Scholarship;
use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('user', 'studyProgram', 'grade', 'scholarship')->get();
        return view('pages.dashboard.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades        = Grade::all();
        $studyPrograms = StudyProgram::all();
        $scholarships  = Scholarship::all();
        return view('pages.dashboard.students.create', compact('grades', 'studyPrograms', 'scholarships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            $validated = $request->safe()->only(['nis', 'email', 'whatsapp', 'whatsapp_parent']);

            // Store to User table
            $storeUser = [
                'name'     => $request->name,
                'username' => $validated['nis'],
                'role_id'  => 3,
                'email'    => $validated['email'],
                'password' => Hash::make($validated['nis']),
            ];
            $user = User::create($storeUser);

            // Store to Student table
            $field = [
                'nis'              => $validated['nis'],
                'whatsapp'         => $validated['whatsapp'],
                'whatsapp_parent'  => $validated['whatsapp_parent'],
                'is_active'        => true,
                'user_id'          => $user->id,
                'study_program_id' => $request->study_program,
                'grade_id'         => $request->grade,
                'scholarship_id'   => $request->scholarship,
            ];
            Student::create($field);

            return redirect()->route('siswa.index')->with([
                'message' => 'Data siswa berhasil ditambahkan',
                'status' => 'success',
            ]);
        } catch (Exception $error) {
            return redirect()->route('siswa.create')->with('message', $error->getMessage());
        }
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
        $student = Student::with('user', 'studyProgram', 'grade')->findOrFail($id);
        $studyPrograms = StudyProgram::all();
        $grades = Grade::all();
        $scholarships = Scholarship::all();
        return view('pages.dashboard.students.edit', compact('student', 'studyPrograms', 'grades', 'scholarships'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
                'whatsapp'         => $wa,
                'whatsapp_parent'  => $validated['whatsapp_parent'],
                'study_program_id' => $request->study_program,
                'grade_id'         => $request->grade,
                'scholarship_id'   => $request->scholarship,
            ];
            $student->update($fields);

            // Update to User table
            $user = User::findOrFail($student->user_id);
            $fiendUser = [
                'name'     => $validated['name'],
                'email'    => $validated['email'],
            ];
            $user->update($fiendUser);

            return redirect()->route('siswa.index')->with([
                'message' => 'Data siswa berhasil diubah',
                'status' => 'success',
            ]);
        } catch (Exception $error) {
            return redirect()->route('siswa.edit', $student->id)->with('message', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $getUser = User::findOrFail($student->user_id);
        $getUser->delete();
        return redirect()->route('siswa.index')->with([
            'message' => 'Data siswa berhasil dihapus',
            'status'  => 'success',
        ]);
    }
}
