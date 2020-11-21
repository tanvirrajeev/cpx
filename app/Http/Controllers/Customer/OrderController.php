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
        $data = DB::table('orders')
            ->where('users_id', Auth::id())
            ->join('statuses', 'statuses.id', '=', 'orders.status_id')
            ->select('orders.id as id','ecomordid','consigneename','statuses.name as statusname','awb')
            ->get();
        // $user = User::all();
        // var_dump($data);
        return Datatables::of($data)
        ->setRowId(function ($data) {
            return $data->id;
            })
        ->editColumn('statusname', function ($data)  { //set Tracking Modal based on status status->tracking.blade
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
        ->addColumn('action', function( $data) {
            return  '<a href="branch/'.$data->id.'/edit" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i><i class="fas fa-edit"></i></a>
            <button class="btn btn-xs btn-danger btn-delete" data-remote="/branch/'. $data->id . '"><i class="fas fa-trash-alt"></i></button>
            ';
        })
        ->rawColumns(['action','statusname'])
        ->make(true);
    }

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

        // return redirect(route('customer.index'));
        // return view('customer.order.index')->with('toast_success','Order Created');
        return redirect(route('customer.order.index'))->with('success','Order Created');
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }


    public function update(Request $request, Order $order)
    {
        //
    }


    public function destroy(Order $order)
    {
        //
    }
}
