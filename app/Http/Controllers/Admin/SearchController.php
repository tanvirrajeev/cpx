<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use Auth;

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

        return response($getsltawb);
    }

    public function statusupdate(Request $request){
        // $sltawb = (isset($_GET['awbchg']) ? $_GET['awbchg'] : '');

        $sltawb = $request->awbchg;

        // dd($sltawb);

        $getsltawb = DB::table('orders')
        ->select('orders.id')
        ->where('orders.awb', $sltawb)
        ->get();

        foreach ($getsltawb as $item) {
            // echo("\n");
            // echo($item->id);
            // echo("\n");

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
