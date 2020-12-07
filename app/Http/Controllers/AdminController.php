<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
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
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $filename = $request->image->getClientOriginalName();

        Pizza::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $filename
        ]);

        $request->image->storeAs('image', $filename, 'public');
        Alert::success('Add Pizza Success!', 'Pizza added');

        return redirect()->route('home');
    }

    public function editPizza(Pizza $pizza)
    {
        return view('admin.edit', ['pizza' => $pizza]);
    }

    public function update(Request $request, Pizza $pizza)
    {
        $request->validate([
            'name' => 'required|max:20',
            'price' => 'required|numeric|min:10000',
            'description' => 'required|min:20',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $filename = $request->image->getClientOriginalName();

        Pizza::where('id', $pizza->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $filename
        ]);

        $request->image->storeAs('image', $filename, 'public');
        Alert::success('Edit Pizza Success!', 'Pizza updated');

        return redirect()->route('home');
    }

    public function deletePizza(Pizza $pizza)
    {
        return view('admin.delete', ['pizza' => $pizza]);
    }

    public function destroy(Pizza $pizza)
    {
        Pizza::destroy($pizza->id);
        Alert::success('Delete Success!', 'Pizza deleted');

        return redirect()->route('home');
    }
}
