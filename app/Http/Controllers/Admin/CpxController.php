<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CpxController extends Controller
{
    public function index(){
        // $user = User::all();
        return view('admin.index');
    }


}
