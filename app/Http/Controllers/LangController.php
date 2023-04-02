<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;

class LangController extends Controller
{
    public function index()
    {
        return view('lang');
    }
}
