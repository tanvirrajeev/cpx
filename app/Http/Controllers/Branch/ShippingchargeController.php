<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shippingcharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
// use Illuminate\Support\Facades\Log;
use Auth;

class ShippingchargeController extends Controller
{

    public function index(){

        return view('branch.settings.shippingcharge');
    }

    public function shippingchargelist(){
        $data = DB::table('shippingcharges')->get();

        return Datatables::of($data)->make(true);
    }


    public function create(){
        //
    }

    public function store(Request $request){

        // dd($request);
        // $scharge = New Shippingcharge;
        $scharge = [];

        if (count($request->all()) > 0 ){

            Shippingcharge::truncate();

            $now = date('Y-m-d H:i:s');
            $minweight = $request->weights;
            $rate = $request->rates;
            $maxweight = $request->mweights;
            $factor = 1;
            $amount = 0;
            // $i = 0;
            for ($minweight; $minweight <= $maxweight; ){
                // Log::info('Weight: '.$minweight);

                $amount = $factor * $rate;
                // Log::info('Amount: '.$amount);

                $scharge[] = [ 'weight' => $minweight, 'factor' => $factor, 'rate' => $rate, 'amount' => $amount, 'updatedby' => Auth::id(), 'created_at' => $now , 'updated_at' => $now ];

                $minweight += 0.5;
                $factor++;
            }
            Shippingcharge::insert($scharge);
            // $scharge = New Shippingcharge;
            // dd($count);
            // Log::info('End of Loop: '.$minweight);
        }else{
            // dd('Empty!');
        }

        // $ord->users_id = Auth::id();
        // $ord->ecomordid = $request->ecomordida;
        // $ord->updatedby = Auth::id();
        // $ord->save();
        // return redirect(route('admin.shippingchargelist'))->with('toast_success','Order Created');
        return view('branch.settings.shippingcharge');
    }

    public function show(Shippingcharge $shippingcharge){
        //
    }

    public function edit(Shippingcharge $shippingcharge){
        //
    }

    public function update(Request $request, Shippingcharge $shippingcharge){
        //
    }


    public function destroy(Shippingcharge $shippingcharge){
        //
    }
}
