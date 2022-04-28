<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\User;
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

        $getAdmin = User::where('role_id', '2')->get();

        return view('pages.dashboard.index', compact('getInvoice', 'getStudents', 'studyPrograms', 'getAdmin'));
    }
}
