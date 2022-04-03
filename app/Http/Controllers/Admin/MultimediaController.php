<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.study-programs.multimedia.index');
    }

    public function kelasX()
    {
        $students = Student::where('study_program_id', 2)
            ->where('grade_id', 1)
            ->with('user', 'grade')
            ->get();
        return view('pages.dashboard.study-programs.multimedia.x.index', compact('students'));
    }

    public function kelasXI()
    {
        $students = Student::where('study_program_id', 2)
            ->where('grade_id', 2)
            ->with('user', 'grade')
            ->get();
        return view('pages.dashboard.study-programs.multimedia.xi.index', compact('students'));
    }

    public function kelasXII()
    {
        $students = Student::where('study_program_id', 2)
            ->where('grade_id', 3)
            ->with('user', 'grade')
            ->get();
        return view('pages.dashboard.study-programs.multimedia.xii.index', compact('students'));
    }
}
