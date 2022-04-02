<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class PerhotelanController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.study-programs.akomodasi-perhotelan.index');
    }

    public function kelasX()
    {
        $students = Student::where('study_program_id', 1)
            ->where('grade_id', 1)
            ->with('user')
            ->get();
        return view('pages.dashboard.study-programs.akomodasi-perhotelan.x.index', compact('students'));
    }

    public function kelasXI()
    {
        $students = Student::where('study_program_id', 1)
            ->where('grade_id', 2)
            ->with('user')
            ->get();
        return view('pages.dashboard.study-programs.akomodasi-perhotelan.xi.index', compact('students'));
    }

    public function kelasXII()
    {
        $students = Student::where('study_program_id', 1)
            ->where('grade_id', 3)
            ->with('user')
            ->get();
        return view('pages.dashboard.study-programs.akomodasi-perhotelan.xii.index', compact('students'));
    }
}
