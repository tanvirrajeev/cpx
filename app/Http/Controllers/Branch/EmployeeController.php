<?php

namespace App\Http\Controllers\Branch;

use App\Role;
use App\User;
use App\Branch;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller{

    public function index(){

        // if (Gate::allows('branch-admin-only', Auth::user())){
        //     return view('branch.settings.employee.index');
        // }else{
        //     // return redirect('/')->with('toast_error','You are not Authorized');
        //     // return redirect(route('branch.dashboard'))->with('errors','You are not Authorized');
        //     Alert::error('You are not Authorized', 'You do not have access to this function');
        //     return Redirect::back();
        // }

        if (Gate::any(['branch-admin-only', 'finance-only'], Auth::user())) {
            return view('branch.settings.employee.index');
        }else{
            // return redirect('/')->with('toast_error','You are not Authorized');
            // return redirect(route('branch.dashboard'))->with('errors','You are not Authorized');
            Alert::error('You are not Authorized', 'You do not have access to this function');
            return Redirect::back();
        }
    }

    public function userlist(){
        $data = DB::table('users')
                // ->where('ecomstatus', 'ARRIVED')
                // ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                // ->select('orders.id as id','ecomordid','consigneename','statuses.name as statusname','note','orders.created_at','awb')
                // ->where('statuses.flag', '99')
                ->where('users.branch_id', '=', Auth::user()->branch_id)
                ->get();

        return Datatables::of($data)     // View Order Page Datatable
        //setting up id to every row
        ->setRowId(function ($data) {
            return $data->id;
            })
        ->addColumn('action', function( $data) {
            return  '<a href="/branch/employee/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
            <a href="/branch/employee/'.$data->id.'/edit" class="btn btn-xs bg-maroon"><i class="fas fa-edit"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function create(){

        $branch = Branch::select('id', 'name')
                ->where('id', '=', Auth::user()->branch_id)
                ->get();

        $role = Role::select('id', 'name')->get();

        return view('branch.settings.employee.create', compact('branch','role'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users|max:255',
            'username'=>'required|unique:users|max:255',
            'password'=>'required|min:6|regex:/[a-z]/|regex:/[0-9]/',
            'address'=>'required',
            'branch'=>'required',
            'role'=>'required',
            'status'=>'required'
         ]);

        $emp = New User;
        $emp->name = $request->name;
        $emp->email = $request->email;
        $emp->username = $request->username;
        $emp->password = Hash::make($request->password);
        $emp->address = $request->address;
        $emp->phone = $request->phone;
        $emp->branch_id = $request->branch;
        $emp->role_id = $request->role;
        $emp->status = $request->status;
        $emp->save();

        return redirect(route('branch.employee.index'))->with('toast_success','User Created');
    }

    public function show($id){
        $branch = Branch::select('id', 'name')
        ->where('id', '!=', '99')
        ->get();

        $role = Role::select('id', 'name')->get();
        $sltuser = User::find($id);
        $sltbranch = Branch::find($sltuser->branch_id);
        $sltrole = Role::find($sltuser->role_id);

        return view('branch.settings.employee.show', compact('branch','role','sltuser','sltbranch','sltrole'));
    }

    public function edit($id){
        $branch = Branch::select('id', 'name')
        ->where('id', '=', Auth::user()->branch_id)
        ->get();

        $role = Role::select('id', 'name')->get();
        $sltuser = User::find($id);
        $sltbranch = Branch::find($sltuser->branch_id);
        $sltrole = Role::find($sltuser->role_id);

        return view('branch.settings.employee.edit', compact('branch','role','sltuser','sltbranch','sltrole'));
    }


    public function update(Request $request, $id){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|max:255',
            'username'=>'required|max:255',
            // 'password'=>'min:6|regex:/[a-z]/|regex:/[0-9]/',
            'address'=>'required',
            'branch'=>'required',
            'role'=>'required',
            'status'=>'required'
         ]);

        $emp = New User;
        $emp = User::find($id);
        $emp->name = $request->name;
        $emp->email = $request->email;
        $emp->username = $request->username;
        if($request->password != ''){
            $emp->password = Hash::make($request->password);
        }
        $emp->address = $request->address;
        $emp->phone = $request->phone;
        $emp->branch_id = $request->branch;
        $emp->role_id = $request->role;
        $emp->status = $request->status;
        $emp->save();

        return redirect(route('branch.employee.index'))->with('toast_success','User Updated');
    }

    public function destroy($id){
        //
    }
}
