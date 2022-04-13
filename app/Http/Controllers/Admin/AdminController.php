<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Student;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Makassar');
        $month = date('m');
        $year  = date('Y');

        $getInvoice = Invoice::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->where('status', '!=', 'PENDING')
            ->get();

        $getStudents = Student::all();

        $studyPrograms = StudyProgram::all();

        return view('pages.dashboard.index', compact('getInvoice', 'getStudents', 'studyPrograms'));
    }
}
