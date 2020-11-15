<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use Auth;
use Carbon\Carbon;

use App\DataTables\OrderDataTable;

class SearchController extends Controller
{

    public function index(){
        return view('admin.search.search-by-awb');
    }

    public function getawb(Request $request){
        $sltawb = (isset($_GET['awb']) ? $_GET['awb'] : '');

        $getsltawb = DB::table('orders')
        ->join('statuses', 'statuses.id', '=', 'orders.status_id')
        ->select('orders.id as cpxid','orders.ecomordid as ecomid','statuses.name as status','orders.awb')
        ->where('orders.awb', $sltawb)
        ->get();

        // return Datatables::of($data)->make(true);

        return response($getsltawb);
    }

    //Status update by AWB from AJAX call search-by-awb.blade
    public function statusupdate(Request $request){
        // $sltawb = (isset($_GET['awbchg']) ? $_GET['awbchg'] : '');

        // Check if the request is empty
        if(!empty($request->awbchg)){
            $sltawb = $request->awbchg;
            // dd($sltawb);

            $getsltawb = DB::table('orders')
                        ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                        ->select('orders.id')
                        ->where('orders.awb', $sltawb)
                        ->where('statuses.name', '<>', 'PACKAGE ON-HOLD')
                        ->where('statuses.name', '<>', 'DELIVERED')
                        ->where('statuses.name', '<>', 'ARRIVED AT DHAKA')
                        ->get();


            foreach ($getsltawb as $item) {
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
                $ord->status_id = '1';
                $ord->note = $ord->note;
                $ord->awb = $ord->awb;
                $ord->ecomrcvby = $ord->ecomrcvby;
                $ord->updatedby = Auth::id();
                $ord->save();
            }
            return response("All CPX ID Updated!");
        }
        // return redirect()->route('admin.search.statusupdate')->with('success','CPX Updated Successfully!');
    }

    public function order(OrderDataTable $dataTable, Request $request ){
        // dd($dataTable->request()->all());
        // $from = date('2020-11-10 00:00:00');
        // $to = date('2020-11-11 23:59:59');
        if($request != 'NULL'){
            dd($request);
            return $dataTable
            ->with([
                'from' => $request->from,
                'to' => $request->to,
                ])
            ->render('admin.search.order');
        }else{
            $from = date('2020-08-01 00:00:00');
            // $to = date('2020-11-11 23:59:59');
            $to = Carbon::now();;
            return $dataTable
            ->with([
                'from' => $from,
                'to' => $to,
                ])
            ->render('admin.search.order');
        }
        // return $dataTable->render('admin.search.order');
    }

    public function datatable(){
        $ord = Order::all();
        return view('admin.search.datatable',compact('ord'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Search $search)
    {
        //
    }

    public function edit(Search $search)
    {
        //
    }

    public function update(Request $request, Search $search)
    {
        //
    }

    public function destroy(Search $search)
    {
        //
    }
}
