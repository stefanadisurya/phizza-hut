<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function getUser()
    {
        $users = User::all();
        return view('admin.getUser', ['users' => $users]);
    }

    public function addPizza()
    {
        return view('admin.add');
    }

    public function store(Request $request)
    {
        $request->image->store('image', 'public');
        return "Upload Success";
    }
}
