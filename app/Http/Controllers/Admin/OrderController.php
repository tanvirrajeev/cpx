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
                ->where('statuses.flag', '1')
                ->orWhere('statuses.flag', '2')
                ->orWhere('statuses.flag', '9')
                ->orWhere('statuses.flag', '0')
                ->get();
        return Datatables::of($data)
        //setting up id to every row
        ->setRowId(function ($data) {
            return $data->id;
            })
        ->editColumn('statusname', function ($data)  {
            if ($data->statusname == "NOT ARRIVED"){
                return '<a data-id='.$data->id.' data-target="#order-created" data-toggle="modal" id="status" href="">'.$data->statusname.'</a>';
            }else if ($data->statusname == "ARRIVED AT DELHI"){
                return '<a data-id='.$data->id.' data-target="#received-at-hub" data-toggle="modal" id="status" href="">'.$data->statusname.'</a>';
            }else if ($data->statusname == "ARRIVED AT DHAKA"){
                return '<a data-id='.$data->id.' data-target="#destination-hub" data-toggle="modal" id="status" href="">'.$data->statusname.'</a>';
            }else if ($data->statusname == "DELIVERED"){
                return '<a data-id='.$data->id.' data-target="#delivered" data-toggle="modal" id="status" href="">'.$data->statusname.'</a>';
            }else{
                return '<a data-id='.$data->id.' data-target="#status" data-toggle="modal" id="status" href="">'.$data->statusname.'</a>';
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

    public function tracking(Request $request){
        $id = (isset($_GET['id']) ? $_GET['id'] : '');
        // $ord = Order::find($id);

        // $ord = DB::table('orders')
        //         ->join('statuses', 'statuses.id', '=', 'orders.status_id')
        //         ->join('users', 'users.id', '=', 'orders.users_id')
        //         ->select('orders.id as ordid','users.name as createdby','orders.created_at','statuses.name as status','awb')
        //         ->where('orders.id', $id)
        //         ->get();

        // $rcvhub = DB::table('histories')
        //         ->join('orders', 'orders.id', '=', 'histories.order_id')
        //         ->select('histories.created_at as delhi-receive-dt','histories.status_id as statusid')
        //         // ->where('histories.status_id', '2')
        //         ->Where('histories.order_id', $id)
        //         ->get();

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
