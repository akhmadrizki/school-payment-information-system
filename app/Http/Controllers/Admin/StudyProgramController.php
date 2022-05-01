<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

// Xendit
use Xendit\Xendit;

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

    public function detailPayment($id)
    {
        Xendit::setApiKey(env('XENDIT_SECRET_API_KEY'));

        // Get User Information
        $getUserId = Invoice::where('id', $id)->first();
        $getUser = User::where('id', $getUserId->user_id)->first();

        $invoice = Invoice::where('id', $id)
            ->with('bill', 'user')
            ->first();

        $getInvoice = \Xendit\Invoice::retrieve($invoice->xendit_id);

        return view('pages.dashboard.study-programs.detail-payment', compact('invoice', 'getInvoice', 'getUser'));
    }
}
