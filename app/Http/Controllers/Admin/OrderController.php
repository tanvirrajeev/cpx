<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Status;

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
                // ->where('status_id', 'NOT ARRIVED')
                // ->orWhere('ecomstatus', 'OTHERS')
                ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                ->select('orders.id as id','ecomordid','consigneename','statuses.name as statusname','note','orders.created_at')
                ->where('statuses.flag', '0')
                ->orWhere('statuses.flag', '1')
                // ->orWhere('ecomstatus', 'OTHERS')
                ->get();
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
                // ->where('ecomstatus', 'ARRIVED')
                ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                ->select('orders.id as id','ecomordid','consigneename','statuses.name as statusname','note','orders.created_at','awb')
                ->get();
        return Datatables::of($data)     // View Order Page Datatable
        //setting up id to every row
        ->setRowId(function ($data) {
            return $data->id;
            })
        ->editColumn('statusname', function ($data)  { //set Tracking Modal based on status
            if ($data->statusname == "NOT ARRIVED"){
                return '<a data-id='.$data->id.' data-target="#tracking" data-toggle="modal" id="status" href="">'.$data->statusname.'</a>';
            }else if ($data->statusname == "ARRIVED AT DELHI"){
                return '<a data-id='.$data->id.' data-target="#tracking" data-toggle="modal" id="status" href="">'.$data->statusname.'</a>';
            }else if ($data->statusname == "ARRIVED AT DHAKA"){
                return '<a data-id='.$data->id.' data-target="#tracking" data-toggle="modal" id="status" href="">'.$data->statusname.'</a>';
            }else if ($data->statusname == "DELIVERED"){
                return '<a data-id='.$data->id.' data-target="#tracking" data-toggle="modal" id="status" href="">'.$data->statusname.'</a>';
            }else{
                return '<a data-id='.$data->id.' data-target="#tracking" data-toggle="modal" id="status" href="">'.$data->statusname.'</a>';
            }
        })
        ->editColumn('created_at', function ($data) {
            return $data->created_at ? with(new Carbon($data->created_at))->format('d/m/Y') : '';
        })
        ->addColumn('action', function( $data) {
            return  '<a href="/admin/order/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
            <a href="/admin/order/'.$data->id.'/edit" class="btn btn-xs btn-danger"><i class="fas fa-edit"></i></a>';
        })
        ->rawColumns(['action','statusname'])
        ->make(true);
    }

    public function statuslist(Request $request){
        $selstat = (isset($_GET['selectedstatus']) ? $_GET['selectedstatus'] : '');
        $statusrow = Status::find($selstat);
        $statusflag = $statusrow->flag;

        return response($statusflag);
    }

    // Get status for Tracking Modal
    public function tracking(Request $request){
        $id = (isset($_GET['id']) ? $_GET['id'] : '');

        $his = DB::table('histories')
                ->join('users', 'users.id', '=', 'histories.user_id')
                ->join('statuses', 'statuses.id', '=', 'histories.status_id')
                ->select('histories.order_id','histories.status_id','users.name','statuses.name as status','histories.awb','histories.note','histories.created_at','histories.reveived_by')
                ->where('histories.order_id', $id)
                ->get();

        return response($his);
        // return response()->json([$ord, $rcvhub]);
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
        $ord->ecompurchaseamt = $request->ecompurchaseamto;
        $ord->ecomorddt = $request->ecomorddtt;
        $ord->consigneename = $request->consigneenamer;
        $ord->consigneeaddrs = $request->consigneeaddrsf;
        $ord->ecomprdtraclnk = $request->ecomprdtraclnke;
        $ord->ecomsppngpriority = $request->ecomsppngpriorityq;
        $ord->status_id = '3';
        $ord->updatedby = Auth::id();
        $ord->save();
        return redirect(route('admin.cpx'))->with('toast_success','Order Created');
    }

    public function show(Order $order){
        $ord = New Order;
        $ord = $order;
        // var_dump($ord);
        return view('admin.order.show',compact('ord'));

    }

    public function edit(Order $order){
        $status = Status::all();
        // var_dump($status);
        return view('admin.order.edit',compact('order','status'));
    }

    public function update(Request $request, $order){
        $ord = New Order;
        $ord = Order::find($order);
        $ord->ecomordid = $request->ecomordida;
        $ord->ecomname = $request->ecomnames;
        $ord->ecomproddesc = $request->ecomproddescd;
        $ord->ecompurchaseamt = $request->ecompurchaseamto;
        $ord->ecomorddt = $request->ecomorddtt;
        $ord->consigneename = $request->consigneenamer;
        $ord->consigneeaddrs = $request->consigneeaddrsf;
        $ord->ecomprdtraclnk = $request->ecomprdtraclnke;
        $ord->ecomsppngpriority = $request->ecomsppngpriorityq;
        $ord->status_id = $request->ecomstatuss;
        $ord->note = $request->note;
        $ord->awb = $request->awbd;
        $ord->ecomrcvby = $request->rcvby;
        $ord->updatedby = Auth::id();
        $ord->save();

        return redirect(route('admin.order.index'))->with('toast_success','Order Updated');
    }

    public function destroy(Order $order)
    {
        //
    }
}
