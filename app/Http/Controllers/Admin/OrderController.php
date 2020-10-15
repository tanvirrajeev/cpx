<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{

    public function index(){

        return view('admin.order.index');

    }

    public function dashboard(){

        return view('admin.order.dashboard');

    }

    public function dashboardlist(){
        $data = DB::table('orders')
                ->where('ecomstatus', 'NOT RECEIVED')
                ->orWhere('ecomstatus', 'OTHERS')
                ->get();
        // $user = User::all();
        // var_dump($data);
        return Datatables::of($data)
        ->editColumn('created_at', function ($data) {
            return $data->created_at ? with(new Carbon($data->created_at))->format('d/m/Y') : '';
        })
        ->addColumn('action', function( $data) {
            return  '<a href="/admin/order/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
            <a href="/admin/order/'.$data->id.'/edit" class="btn btn-xs btn-danger"><i class="fas fa-edit"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function orderlist(){
        $data = DB::table('orders')
                ->where('ecomstatus', 'RECEIVED')
                ->get();
        // $user = User::all();
        // var_dump($data);
        return Datatables::of($data)
        ->editColumn('created_at', function ($data) {
            return $data->created_at ? with(new Carbon($data->created_at))->format('d/m/Y') : '';
        })
        ->addColumn('action', function( $data) {
            return  '<a href="/admin/order/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);

        // <a href="/admin/order/'.$data->id.'/edit" class="btn btn-xs btn-danger"><i class="fas fa-edit"></i></a>';
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
        // return view('admin.index');
        return redirect(route('admin.home'))->with('toast_success','Order Created');
    }

    public function show(Order $order){
        $ord = New Order;
        $ord = $order;
        // var_dump($ord);
        return view('admin.order.show',compact('ord'));

    }

    public function edit(Order $order){
        // var_dump($order);
        return view('admin.order.edit',compact('order'));
    }

    public function update(Request $request, $order){
        $ord = New Order;
        $ord = Order::find($order);
        $ord->ecomordid = $request->ecomordida;
        $ord->ecomname = $request->ecomnames;
        $ord->ecomproddesc = $request->ecomproddescd;
        $ord->ecomorddt = $request->ecomorddtt;
        $ord->consigneename = $request->consigneenamer;
        $ord->consigneeaddrs = $request->consigneeaddrsf;
        $ord->ecomprdtraclnk = $request->ecomprdtraclnke;
        $ord->ecomsppngpriority = $request->ecomsppngpriorityq;
        $ord->ecomstatus = $request->ecomstatuss;
        $ord->note = $request->note;
        $ord->awb = $request->awbd;
        $ord->updatedby = Auth::id();
        $ord->save();

        return redirect(route('admin.dashboard'))->with('toast_success','Order Updated');
    }

    public function destroy(Order $order)
    {
        //
    }
}
