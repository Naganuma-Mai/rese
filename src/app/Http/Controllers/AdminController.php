<?php

namespace App\Http\Controllers;

use App\Models\Representative;

class AdminController extends Controller
{
    public function index()
    {
        $representatives = Representative::all();

        return view('admin_admin', compact('representatives'));
    }
}
