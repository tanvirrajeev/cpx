<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderExport;

class OrderexportController extends Controller
{

    public function index(){
        // $ord = Order::paginate(10);
        $ord = DB::table('orders')
        ->join('statuses', 'statuses.id', '=', 'orders.status_id')
        ->select('orders.id as id','ecomordid','consigneename','statuses.name as statusname','note','orders.created_at','awb')
            ->paginate(15);
        return view('branch.report.order', compact('ord'));
    }

    // public function orderexport_view(){
    //     return Excel::download(new OrderExport(), 'order.csv');
    // }

    public function orderexport_view(Request $request){
        // dd($request->all());
        $from_date=$request->from_date;
        $to_date = $request->to_date;


        return Excel::download(new OrderExport($from_date,$to_date), 'order.csv');
        // return Excel::download(new OrderExport(), 'order.csv');
    }

    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }
}
