<?php

namespace App\Http\Controllers\Admin;

use App\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{

    public function index(){
        return view('branch.settings.employee.index');
    }

    public function stlist(){
        $data = DB::table('statuses')
                // ->join('users', 'users.id', '=', 'statuses.user_id')
                // ->select('statuses.name as name','users.name as user')
                // ->where('statuses.flag', '99')
                // ->where('users.branch_id', '=', Auth::user()->branch_id)
                ->get();

                // dd($data);

        return Datatables::of($data)     // View Order Page Datatable
        //setting up id to every row
        ->setRowId(function ($data) {
            return $data->id;
            })
        ->addColumn('action', function( $data) {
            return  '<a href="/admin/status/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
            <a href="/admin/status/'.$data->id.'/edit" class="btn btn-xs bg-maroon"><i class="fas fa-edit"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }


    public function create(){
        //
    }



    public function store(Request $request){
        //
    }


    public function show(Status $status){
        //
    }



    public function edit(Status $status){
        //
    }


    public function update(Request $request, Status $status){
        //
    }


    public function destroy(Status $status){
        //
    }
}
