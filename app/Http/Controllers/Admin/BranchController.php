<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class BranchController extends Controller{

    public function index(){
        return view('admin.settings.branch.index');
    }

    public function branchlist(){
        $data = DB::table('branches')
                // ->where('ecomstatus', 'ARRIVED')
                // ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                // ->select('orders.id as id','ecomordid','consigneename','statuses.name as statusname','note','orders.created_at','awb')
                // ->where('statuses.flag', '99')
                ->where('branches.name', '<>', 'N/A')
                ->get();

        return Datatables::of($data)     // View Order Page Datatable
        //setting up id to every row
        ->setRowId(function ($data) {
            return $data->id;
            })
        ->addColumn('action', function( $data) {
            return  '<a href="/admin/branch/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
            <a href="/admin/branch/'.$data->id.'/edit" class="btn btn-xs bg-maroon"><i class="fas fa-edit"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }


    public function create(){

        return view('admin.settings.branch.create');
    }



    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:branches',
            'location'=>'required',
            'address'=>'required'
         ]);

        $br = New Branch();
        $br->name = $request->name;
        $br->location = $request->location;
        $br->address = $request->address;
        $br->save();

        return redirect(route('admin.branch.index'))->with('toast_success','Branch Created');
    }



    public function show(Branch $branch){

        return view('admin.settings.branch.show', compact('branch'));
    }



    public function edit(Branch $branch){

        return view('admin.settings.branch.edit', compact('branch'));
    }


    public function update(Request $request, Branch $branch){
        $this->validate($request,[
            'name'=>'required',
            'location'=>'required',
            'address'=>'required'
         ]);

        //  dd($branch->id);

         $br = New Branch();
         $br = Branch::find($branch->id);
         $br->name = $request->name;
         $br->location = $request->location;
         $br->address = $request->address;
         $br->save();

         return redirect(route('admin.branch.index'))->with('toast_success','Branch Updated');
    }


    public function destroy(Branch $branch){
        //
    }
}
