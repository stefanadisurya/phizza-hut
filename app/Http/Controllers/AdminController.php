<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pizza;

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
        $this->validate($request, [
            'name' => 'required|max:20',
            'price' => 'required|numeric|min:10000',
            'description' => 'required|min:20',
            'image' => 'required',
        ]);

        $filename = $request->image->getClientOriginalName();

        Pizza::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $filename
        ]);

        $request->image->storeAs('image', $filename, 'public');

        return redirect()->back();
    }
}
