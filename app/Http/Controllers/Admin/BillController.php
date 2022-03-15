<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Grade;
use Illuminate\Http\Request;

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
        Bill::create($field);

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
