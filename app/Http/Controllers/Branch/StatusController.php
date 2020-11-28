<?php

namespace App\Http\Controllers\Branch;

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
        return view('branch.status.index');
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
            return  '<a href="/branch/status/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
            <a href="/branch/status/'.$data->id.'/edit" class="btn btn-xs bg-maroon"><i class="fas fa-edit"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }


    public function create(){
        return view('branch.status.create');
    }



    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:statuses|max:255',
            'flag'=>'required'
         ]);



        $st = New Status;
        $st->name = strtoupper($request->name);
        $st->flag = $request->flag;
        $st->user_id = Auth::id();
        $st->save();
        return redirect(route('branch.status.index'))->with('toast_success','Status Created');
    }


    public function show(Status $status){
        $st = DB::table('statuses')
                ->join('users', 'users.id', '=', 'statuses.user_id')
                ->select('statuses.name as name', 'statuses.flag as flag', 'statuses.created_at as date', 'users.name as user')
                ->where('statuses.id', '=', $status->id)
                ->first();
        // dd($st);

        return view('branch.status.show',compact('st'));
    }



    public function edit(Status $status){
        return view('branch.status.edit',compact('status'));
    }


    public function update(Request $request, Status $status){
        $this->validate($request,[
            'name'=>'required|unique:statuses|max:255',
            'flag'=>'required'
         ]);



        $st = Status::find($status);
        $st->name = strtoupper($request->name);
        $st->flag = $request->flag;
        $st->user_id = Auth::id();
        $st->save();
        return redirect(route('branch.status.index'))->with('toast_success','Status Updated');
    }


    public function destroy(Status $status){
        //
    }
}
