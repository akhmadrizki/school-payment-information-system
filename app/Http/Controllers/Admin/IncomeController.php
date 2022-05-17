<?php

namespace App\Http\Controllers\Admin;

use App\Exports\IncomeExport;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month;
        $year  = $request->year;

        $formatMonth = Carbon::parse($month)->format('m');

        $invoices = Invoice::whereMonth('created_at', $formatMonth)
            ->whereYear('created_at', $year)
            ->where('status', '!=', 'PENDING')
            ->with('user.students.studyProgram', 'bill.grade', 'user.students.scholarship')
            ->get();

        return view('pages.dashboard.income.index', compact('month', 'year', 'invoices', 'request'));
    }

    public function export(Request $request)
    {
        $month = $request->month;
        $year  = $request->year;
        $formatFile = 'xlsx';
        $filename   = 'Laporan Pendapatan SPP' . ' ' . $month . '-' . $year . '.' . $formatFile;

        return Excel::download(new IncomeExport($request), $filename);
    }
}
