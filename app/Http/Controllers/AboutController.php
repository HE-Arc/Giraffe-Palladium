<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AboutController extends Controller
{
    /**
     * Display the about page.
     */
    public function index()
    {
        return view('about');
    }
}
