<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CpxController extends Controller
{
    public function index(){
        // $user = User::all();
        return view('customer.index');
    }

}

