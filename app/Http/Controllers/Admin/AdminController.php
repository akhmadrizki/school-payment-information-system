<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.index');
    }

    public function multimedia()
    {
        return view('pages.dashboard.study-programs.multimedia.index');
    }

    public function tataBoga()
    {
        return view('pages.dashboard.study-programs.tata-boga.index');
    }

    public function tataNiaga()
    {
        return view('pages.dashboard.study-programs.tata-niaga.index');
    }
}
