<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Order;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
// use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{

    public function index(){
        // Alert::success('Success Title', 'Success Message');
        return view('customer.order.index');

    }

    public function orderlist(){
        $data = DB::table('orders')->where('users_id', Auth::id())->get();
        // $user = User::all();
        // var_dump($data);
        return Datatables::of($data)
        ->addColumn('action', function( $data) {
            return  '<a href="branch/'.$data->id.'/edit" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i><i class="fas fa-edit"></i></a>
            <button class="btn btn-xs btn-danger btn-delete" data-remote="/branch/'. $data->id . '"><i class="fas fa-trash-alt"></i></button>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function create(){
        //
    }


    public function store(Request $request){
        $ord = New Order;
        $ord->users_id = Auth::id();
        $ord->ecomordid = $request->ecomordida;
        $ord->ecomname = $request->ecomnames;
        $ord->ecomproddesc = $request->ecomproddescd;
        $ord->ecomorddt = $request->ecomorddtt;
        $ord->consigneename = $request->consigneenamer;
        $ord->consigneeaddrs = $request->consigneeaddrsf;
        $ord->ecomprdtraclnk = $request->ecomprdtraclnke;
        $ord->ecomsppngpriority = $request->ecomsppngpriorityq;
        $ord->ecomstatus = 'NOT RECEIVED';
        $ord->updatedby = Auth::id();
        $ord->save();

        // return redirect(route('customer.index'));
        // return view('customer.order.index')->with('toast_success','Order Created');
        return redirect(route('customer.order.index'))->with('success','Order Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
