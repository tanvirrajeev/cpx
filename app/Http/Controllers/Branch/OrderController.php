<?php

namespace App\Http\Controllers\Branch;

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

        return view('branch.order.index');

    }

    public function dashboard(){

        return view('branch.order.dashboard');

    }

    public function dashboardlist(){
        // $data = DB::table('orders')
        //         // ->where('status_id', 'NOT ARRIVED')
        //         // ->orWhere('ecomstatus', 'OTHERS')
        //         ->join('statuses', 'statuses.id', '=', 'orders.status_id')
        //         ->select('orders.id as id','ecomordid','consigneename','statuses.name as statusname','note','orders.created_at')
        //         ->where('statuses.flag', '0')
        //         // ->orWhere('ecomstatus', 'OTHERS')
        //         ->get();
        // // $data = Order::select();
        // // var_dump($data);
        // return Datatables::of($data)
        // ->editColumn('created_at', function ($data) {
        //     return $data->created_at ? with(new Carbon($data->created_at))->format('d/m/Y') : '';
        // })
        // ->addColumn('action', function( $data) {
        //     return  '<a href="/branch/order/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
        //     <a href="/branch/order/'.$data->id.'/edit" class="btn btn-xs btn-danger"><i class="fas fa-edit"></i></a>';
        // })
        // ->rawColumns(['action'])
        // ->make(true);

        $data = DB::table('orders')
        // ->where('ecomstatus', 'ARRIVED')
            ->join('statuses', 'statuses.id', '=', 'orders.status_id')
            ->select('orders.id as id','ecomordid','consigneename','statuses.name as statusname','note','orders.created_at','awb')
            ->whereBetween('statuses.flag', [0, 98])
            ->get();

        return Datatables::of($data)     // View Order Page Datatable
            //setting up id to every row
            ->setRowId(function ($data) {
                return $data->id;
                })
            ->editColumn('id', function ($data)  { //set Tracking Modal based on status
                return '<a data-id='.$data->id.' data-target="#cpx" data-toggle="modal" id="cpx" href="">'.$data->id.'</a>';
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
            ->editColumn('created_at', function ($data) {
                // return $data->created_at ? with(new Carbon($data->created_at))->format('d-M-Y') : '';
                $date = $data->created_at ? with(new Carbon($data->created_at))->format('d-M-Y') : '';
                return '<a data-id='.$data->id.' data-target="#history" data-toggle="modal" id="cpx" href="">'.$date.'</a>';
            })
            ->addColumn('action', function( $data) {
                return  '<a data-id='.$data->id.' data-target="#chgstatusmodal" data-toggle="modal" id="status" class="btn btn-xs bg-maroon" href=""><i class="fas fa-exchange-alt"></i></a>
                <a href="/branch/order/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
                <a href="/branch/order/'.$data->id.'/edit" class="btn btn-xs bg-purple"><i class="fas fa-edit"></i></a>';
            })
            ->rawColumns(['action','statusname','id','created_at'])
            ->make(true);

    }

    public function orderlist(){
        // $data = DB::table('orders')
        //         // ->where('ecomstatus', 'ARRIVED')
        //         ->join('statuses', 'statuses.id', '=', 'orders.status_id')
        //         ->select('orders.id as id','ecomordid','consigneename','statuses.name as statusname','note','orders.created_at','awb')
        //         ->where('statuses.flag', '1')
        //         ->orWhere('statuses.flag', '2')
        //         ->get();
        // // $user = User::all();
        // // var_dump($data);
        // return Datatables::of($data)
        // ->editColumn('created_at', function ($data) {
        //     return $data->created_at ? with(new Carbon($data->created_at))->format('d/m/Y') : '';
        // })
        // ->addColumn('action', function( $data) {
        //     return  '<a href="/branch/order/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>';
        // })
        // ->rawColumns(['action'])
        // ->make(true);

        // <a href="/admin/order/'.$data->id.'/edit" class="btn btn-xs btn-danger"><i class="fas fa-edit"></i></a>';


        $data = DB::table('orders')
        // ->where('ecomstatus', 'ARRIVED')
        ->join('statuses', 'statuses.id', '=', 'orders.status_id')
        ->select('orders.id as id','ecomordid','consigneename','statuses.name as statusname','note','orders.created_at','awb')
        ->where('statuses.flag', '99')
        ->get();

        return Datatables::of($data)     // View Order Page Datatable
        //setting up id to every row
        ->setRowId(function ($data) {
            return $data->id;
            })
        ->editColumn('id', function ($data)  { //set Tracking Modal based on status
            return '<a data-id='.$data->id.' data-target="#cpx" data-toggle="modal" id="cpx" href="">'.$data->id.'</a>';
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
        ->editColumn('created_at', function ($data) {
            // return $data->created_at ? with(new Carbon($data->created_at))->format('d-M-Y') : '';
            $date = $data->created_at ? with(new Carbon($data->created_at))->format('d-M-Y') : '';
            return '<a data-id='.$data->id.' data-target="#history" data-toggle="modal" id="cpx" href="">'.$date.'</a>';
        })
        ->addColumn('action', function( $data) {
            return  '<a href="/branch/order/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
            <a href="/branch/order/'.$data->id.'/edit" class="btn btn-xs bg-maroon"><i class="fas fa-edit"></i></a>';
        })
        ->rawColumns(['action','statusname','id','created_at'])
        ->make(true);
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

    public function statuslist(Request $request){
        $selstat = (isset($_GET['selectedstatus']) ? $_GET['selectedstatus'] : '');
        // $status = App\Status::find($selectedstatus);
        // $statusflag = $status->flag;
        // var_dump($statusflag);
        // $specstatusg = App\Status::find($selstat);
        // $statusflag = $specstatusg->flag;

        $statusrow = Status::find($selstat);
        $statusflag = $statusrow->flag;

        return response($statusflag);
    }

    public function create(){
        //
    }


    public function store(Request $request){

        $this->validate($request,[
            'ecomordid'=>'required|unique:orders|max:255',
            'ecomname'=>'required',
            'ecomproddesc'=>'required',
            'ecomorddt'=>'required',
            'consigneename'=>'required',
            'consigneeaddrs'=>'required'
         ]);


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
        // return view('admin.index');
        return redirect(route('branch.cpx'))->with('toast_success','Order Created');
    }

    public function show(Order $order){
        $ord = New Order;
        $ord = $order;
        // var_dump($ord);
        return view('branch.order.show',compact('ord'));

    }

    public function edit(Order $order){
        $status = Status::all();
        // var_dump($status);
        return view('branch.order.edit',compact('order','status'));
    }

    public function update(Request $request, $order){

        $this->validate($request,[
            'ecomname'=>'required',
            'ecomproddesc'=>'required',
            'ecomorddt'=>'required',
            'consigneename'=>'required',
            'consigneeaddrs'=>'required'
         ]);



         $ord = New Order;
         $ord = Order::find($order);
         $ord->ecomordid = $request->ecomordid;
         $ord->ecomname = $request->ecomname;
         $ord->ecomproddesc = $request->ecomproddesc;
         $ord->ecompurchaseamt = $request->ecompurchaseamto;
         $ord->ecomorddt = $request->ecomorddt;
         $ord->consigneename = $request->consigneename;
         $ord->consigneeaddrs = $request->consigneeaddrs;
         $ord->ecomprdtraclnk = $request->ecomprdtraclnke;
         $ord->ecomsppngpriority = $request->ecomsppngpriority;
         $ord->status_id = $request->ecomstatuss;
         $ord->note = $request->note;
         $ord->awb = $request->awbd;
         $ord->ecomrcvby = $request->rcvby;
         $ord->updatedby = Auth::id();
         $ord->save();

        return redirect(route('branch.dashboard'))->with('toast_success','Order Updated');
    }

    //Get Order from CPX Modal
    public function getorder(Request $request){
        $id = (isset($_GET['id']) ? $_GET['id'] : '');

        if($id !== ''){

            $ord = DB::table('orders')
                    ->where('orders.id', $id)
                    ->get();

            // return response()->json(['status'=>$status, 'order'=>$ord ]);
            return response($ord);
        }else{
            return response("Error. Form Blank!");
        }
    }


    //Get Status to change from Order page Modal chgstatusmodal.blade
    public function getstatusmodal(Request $request){
        $id = (isset($_GET['id']) ? $_GET['id'] : '');

        if($id !== ''){
            $allstatus = DB::table('statuses')
                        ->select('statuses.id as status_id', 'statuses.name as status_name')
                        ->get();

            $sltord = DB::table('Orders')
                    ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                    ->select('orders.id as cpxid','orders.awb as awb','orders.note as note','orders.ecomrcvby as rcvby','statuses.id as selected_status_id','statuses.name as selectes_status')
                    ->where('orders.id', $id)
                    ->get();
            $status = $allstatus->toArray();
            $ord = $sltord->toArray();

            return response()->json(['status'=>$status, 'order'=>$ord ]);
        }else{
            return response("Error. Form Blank!");
        }
    }

    //Status change from Order page Modal chgstatusmodal.blade
    public function chgstatusmodal(Request $request){
        if(!empty($request->id)){
            $cpxid = $request->id;
            $sts = $request->status;

            $getord = DB::table('orders')
                        ->where('orders.id', $cpxid)
                        ->get();
            // $ordarry =  $getord->toArray();

            foreach ($getord as $item) {
                $ord = New Order;
                $ord = Order::find($item->id);
                $ord->ecomordid = $ord->ecomordid;
                $ord->ecomname = $ord->ecomname;
                $ord->ecomproddesc = $ord->ecomproddesc;
                $ord->ecompurchaseamt = $ord->ecompurchaseamt;
                $ord->ecomorddt = $ord->ecomorddt;
                $ord->consigneename = $ord->consigneename;
                $ord->consigneeaddrs = $ord->consigneeaddrs;
                $ord->ecomprdtraclnk = $ord->ecomprdtraclnk;
                $ord->ecomsppngpriority = $ord->ecomsppngpriority;
                $ord->status_id = $sts;
                $ord->note = $request->note;
                $ord->awb = $request->awb;
                $ord->ecomrcvby = $request->rcvby;
                $ord->updatedby = Auth::id();
                $ord->save();
            }

            return response("CPX Updated!");
        }
    }

        //Get History from history Modal
        public function gethistory(Request $request){
            $id = (isset($_GET['id']) ? $_GET['id'] : '');

            if($id !== ''){

                $ord = DB::table('histories')
                        ->join('users', 'users.id', '=', 'histories.user_id')
                        ->join('branches', 'branches.id', '=', 'users.branch_id')
                        ->join('statuses', 'statuses.id', '=', 'histories.status_id')
                        ->select('histories.id as hisid','histories.created_at as date','statuses.name as status','histories.note as note','users.name as updateby','branches.name as branch')
                        ->where('histories.order_id', $id)
                        ->get();

                // return response()->json(['status'=>$status, 'order'=>$ord ]);
                return response($ord);
            }else{
                return response("Error. Form Blank!");
            }
        }

    public function destroy(Order $order)
    {
        //
    }
}
