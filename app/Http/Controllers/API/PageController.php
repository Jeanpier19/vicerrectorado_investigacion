<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('layouts.admin.master');
    }
}
