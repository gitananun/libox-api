<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ViewController extends Controller
{
    public function index(): View
    {
        return view('index');
    }
}