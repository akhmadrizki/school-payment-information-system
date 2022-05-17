<?php

namespace App\Exports;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class IncomeExport implements FromView
{

    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $month = $this->request->month;
        $year  = $this->request->year;

        $formatMonth = Carbon::parse($month)->format('m');

        $invoices = Invoice::whereMonth('created_at', $formatMonth)
            ->whereYear('created_at', $year)
            ->where('status', '!=', 'PENDING')
            ->with('user.students.studyProgram', 'bill.grade', 'user.students.scholarship')
            ->get();

        return view('export.income-export', [
            'year'  => $year,
            'month' => $month,
            'invoices' => $invoices
        ]);
    }
}
