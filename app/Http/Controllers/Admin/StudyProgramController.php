<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

// Xendit
use Xendit\Xendit;

// Twilio
use Twilio\Rest\Client;

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
            ->with('bill', 'user.students.scholarship')
            ->first();

        $getInvoice = \Xendit\Invoice::retrieve($invoice->xendit_id);

        return view('pages.dashboard.study-programs.detail-payment', compact('invoice', 'getInvoice', 'getUser'));
    }

    public function sendReminder($id)
    {
        $getUserId = Invoice::where('id', $id)->first();
        $getUser = User::where('id', $getUserId->user_id)->first();

        $invoice = Invoice::where('id', $id)
            ->with('bill', 'user.students.scholarship')
            ->first();

        // Twilio
        $twilioSID = env('TWILIO_SID');
        $twilioToken = env('TWILIO_TOKEN');

        $message = "Hallo " . " Siswa atas nama " . $getUser->name . ", diingatkan untuk segera melakukan pembayaran SPP pada bulan " . $invoice->bill->month . " " . $invoice->bill->year . "\n\nLink pembayaran: \n" . $invoice->invoice_url . "\n\nMohon untuk tidak membalas pesan ini." . "\nSekian dan terimakasih" . "\n\n- Bendahara SMK Nusa Dua";

        // Send whatsaap
        $twilio = new Client($twilioSID, $twilioToken);
        $twilio->messages->create(
            'whatsapp:+6281238483464',
            [
                'from' => 'whatsapp:+14155238886',
                'body' => $message,
            ]
        );

        return redirect()->route('tunggakan.index')->with([
            'message' => 'Pesan berhasil dikirim',
            'status'  => 'success',
        ]);
    }
}
