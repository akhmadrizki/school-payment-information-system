<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class TataNiagaController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.study-programs.tata-niaga.index');
    }

    public function kelasX()
    {
        $students = Student::where('study_program_id', 4)
            ->where('grade_id', 1)
            ->with('user')
            ->get();
        return view('pages.dashboard.study-programs.tata-niaga.x.index', compact('students'));
    }

    public function kelasXI()
    {
        $students = Student::where('study_program_id', 4)
            ->where('grade_id', 2)
            ->with('user')
            ->get();
        return view('pages.dashboard.study-programs.tata-niaga.xi.index', compact('students'));
    }

    public function kelasXII()
    {
        $students = Student::where('study_program_id', 4)
            ->where('grade_id', 3)
            ->with('user')
            ->get();
        return view('pages.dashboard.study-programs.tata-niaga.xii.index', compact('students'));
    }
}
