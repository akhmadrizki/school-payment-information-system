<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerhotelanController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.study-programs.akomodasi-perhotelan.index');
    }

    public function kelasX()
    {
        return view('pages.dashboard.study-programs.akomodasi-perhotelan.x.index');
    }
}
