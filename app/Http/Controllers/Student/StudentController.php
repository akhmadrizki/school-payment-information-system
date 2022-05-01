<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Xendit
use Xendit\Xendit;

class StudentController extends Controller
{
    public function paymentInfo()
    {
        $getUserActive = Auth::user()->id;
        $getUser = User::where('id', $getUserActive)->first();

        $invoice = Invoice::where('user_id', $getUserActive)
            ->with('bill', 'user')
            ->latest()
            ->get();

        return view('pages.dashboard.student-session.payment-info', compact('invoice', 'getUser'));
    }

    public function paymentDetail(Request $request, $id)
    {
        Xendit::setApiKey(env('XENDIT_SECRET_API_KEY'));

        $getUserActive = Auth::user()->id;
        $getUser = User::where('id', $getUserActive)->first();

        $invoice = Invoice::where('id', $id)
            ->with('bill', 'user')
            ->first();

        $getInvoice = \Xendit\Invoice::retrieve($invoice->xendit_id);

        return view('pages.dashboard.student-session.payment-detail', compact('invoice', 'getInvoice', 'getUser'));
    }
}
