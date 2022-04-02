<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

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
            'invoices.user.students.grade'
        ])
            ->findOrFail($id);

        return view('pages.dashboard.debt.detail', compact('bills'));
    }
}
