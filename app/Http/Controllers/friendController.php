<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class friendController extends Controller
{
    public function index(): View
    {
        return view('friend.index');
    }
}