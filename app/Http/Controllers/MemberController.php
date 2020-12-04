<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

class MemberController extends Controller
{
    public function show(Pizza $pizza){
        // echo json_encode($pizza);
        // die();
        return view('PizzaDetailInfo', ['pizza' => $pizza]);
    }
}
