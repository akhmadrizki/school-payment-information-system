<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;

// Twilio
use Twilio\Rest\Client;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::with([
            'grade',
            'scholarship',
            'invoices' => function ($query) {
                $query->where('status', 'PENDING');
            }
        ])
            ->get()
            ->sortBy('month');

        return view('pages.dashboard.debt.index', compact('bills'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bills = Bill::with([
            'grade',
            'invoices' => function ($query) {
                $query->where('status', 'PENDING');
            },
            'invoices.user.students.studyProgram',
            'invoices.user.students.grade',
            'invoices.user.students.scholarship'
        ])
            ->findOrFail($id);

        return view('pages.dashboard.debt.detail', compact('bills'));
    }

    public function sendReminder($id)
    {
        $bills = Bill::with([
            'grade',
            'invoices' => function ($query) {
                $query->where('status', 'PENDING');
            },
            'invoices.user'
        ])
            ->findOrFail($id);



        $getUser = User::where('id', $bills->invoices->first()->user_id)->first();
        $getUrlInv = $bills->invoices->first()->invoice_url;
        $message = "Hallo " . " Siswa atas nama " . $getUser->name . ", diingatkan untuk segera melakukan pembayaran SPP pada bulan " . $bills->month . " " . $bills->year . "\n\nLink pembayaran: \n" . $getUrlInv . "\n\nMohon untuk tidak membalas pesan ini." . "\nSekian dan terimakasih" . "\n\n- Bendahara SMK Nusa Dua";

        // Twilio
        $twilioSID = env('TWILIO_SID');
        $twilioToken = env('TWILIO_TOKEN');

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
