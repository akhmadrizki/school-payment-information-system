<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    public function detail($id)
    {
        $student = Student::where('id', $id)
            ->with('user')
            ->first();

        $invoice = Invoice::where('user_id', $student->user->id)
            ->with('bill')
            ->get();

        return view('pages.dashboard.study-programs.detail', compact('student', 'invoice'));
    }
}
