<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

class MemberController extends Controller
{
    public function show(Pizza $pizza)
    {
        return view('show', ['pizza' => $pizza]);
    }
}
