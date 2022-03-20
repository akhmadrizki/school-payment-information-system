<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Grade;
use App\Models\Invoice;
use App\Models\Student;
use DateTime;
use Illuminate\Http\Request;

// Twilio
use Twilio\Rest\Client;
// Xendit
use Xendit\Xendit;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::with('grade')->get();
        return view('pages.dashboard.bill.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        date_default_timezone_set('Asia/Makassar');

        $grades = Grade::all();
        return view('pages.dashboard.bill.create', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $field = [
            'month'       => $request->month,
            'year'        => $request->year,
            'total'       => $request->total,
            'description' => $request->description,
            'grade_id'    => $request->grade_id,
        ];
        $bill = Bill::create($field);

        // Get all student with grade choosen
        $students = Student::where('grade_id', $bill->grade_id)
            ->with('user')
            ->get();

        // Xendit Payment
        Xendit::setApiKey(env('XENDIT_SECRET_API_KEY'));

        // Store data to invoice
        $temp = [];

        foreach ($students as $student) {
            $invoice = new Invoice;
            $invoice->user_id = $student->user->id;
            $invoice->invoice_code = Invoice::generateCode();
            $invoice->total = $bill->total;
            $invoice->save();

            array_push(
                $temp,
                $student->user->id
            );
        }

        // Get invoice with previous data
        $getInvoice = Invoice::whereIn('user_id', $temp)
            ->with('user')
            ->get();

        // Store data to xendit
        foreach ($getInvoice as $data) {
            $xendit = \Xendit\Invoice::create([
                'external_id'       => $data->invoice_code,
                'payer_email'       => $data->user->email,
                'description'       => $bill->description,
                'amount'            => $bill->total,
                'customer'          => [
                    'email' => $data->user->email,
                    'mobile_number' => $data->user->students->whatsapp,
                    'name' => $data->user->name,
                ],
                'customer_notification_preference' => [
                    'invoice_created' => [
                        'whatsapp'
                    ],
                    'invoice_reminder' => [
                        'whatsapp'
                    ],
                    'invoice_paid' => [
                        'whatsapp'
                    ],
                    'invoice_expired' => [
                        'whatsapp'
                    ]
                ],
                'should_send_email' => true,
            ]);

            // Update invoice data
            $fields = [
                'status' => $xendit['status'],
                'invoice_url' => $xendit['invoice_url'],
                'expiry_date' => new DateTime($xendit['expiry_date']),
                'xendit_id' => $xendit['id'],
            ];

            $data->update($fields);
        }

        return redirect()->route('bill.index')->with([
            'message' => 'Tagihan berhasil ditambahkan',
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bill::findOrFail($id);
        $grades = Grade::all();
        return view('pages.dashboard.bill.edit', compact('bill', 'grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bill = Bill::findOrFail($id);
        $fields = [
            'month'       => $request->month,
            'year'        => $request->year,
            'total'       => $request->total,
            'description' => $request->description,
            'grade_id'    => $request->grade_id,
        ];

        $bill->update($fields);
        return redirect()->route('bill.index')->with([
            'message' => 'Tagihan berhasil diubah',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->delete();
        return redirect()->route('bill.index')->with([
            'message' => 'Tagihan berhasil dihapus',
            'status' => 'success',
        ]);
    }
}
