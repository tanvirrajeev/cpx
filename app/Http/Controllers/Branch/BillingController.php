<?php



namespace App\Http\Controllers\Branch;
use Auth;
use App\Billing;
use Carbon\Carbon;
use App\Shippingcharge;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\User;
// use Alert;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class BillingController extends Controller
{

    public function index(){

        if (Gate::allows('finance-only', Auth::user())){
            return view('branch.billing.index');
        }else{
            // return redirect('/')->with('toast_error','You are not Authorized');
            // return redirect(route('branch.dashboard'))->with('errors','You are not Authorized');
            Alert::error('You are not Authorized', 'You do not have access to this function');
            return Redirect::back();
        }
    }

    public function billinglist(){
        $data = DB::table('billings')
                ->get();
        // $user = User::all();
        // var_dump($data);
        return Datatables::of($data)
        ->addColumn('action1', function( $data) {
            return  '<a href="/branch/billing/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
            <a href="/branch/billing/'.$data->id.'/edit" class="btn btn-xs btn-danger"><i class="fas fa-edit"></i></a>';
        })
        ->addColumn('action2', function( $data) {
            return  '<a href="/branch/billing/'.$data->id.'/entry" class="btn btn-xs btn-primary">ENTRY</a>';
        })
        ->rawColumns(['action1', 'action2'])
        ->make(true);

        // <a href="/admin/order/'.$data->id.'/edit" class="btn btn-xs btn-danger"><i class="fas fa-edit"></i></a>';
    }

    public function shippingchargelist(Request $request){
        $selstat = (isset($_GET['selectedstatus']) ? $_GET['selectedstatus'] : '');
        // dd($selstat);
        $spchargeow = Shippingcharge::find($selstat);
        // $statusflag = $statusrow->flag;

        return response($spchargeow);
    }


    public function create()
    {
        //
    }

    public function store(Request $request){
        //
    }

    public function show(Billing $billing){

        if (Gate::allows('finance-only', Auth::user())){
            $spcharge = DB::table('shippingcharges')
            ->select('shippingcharges.id as id','shippingcharges.weight as weight')
            ->get();

            return view('branch.billing.show',compact('billing','spcharge'));
        }else{
            // return redirect('/')->with('toast_error','You are not Authorized');
            Alert::error('You are not Authorized', 'You do not have access to this function');
            return Redirect::back();
        }
    }

    public function edit(Billing $billing){

        if (Gate::allows('finance-only', Auth::user())){

            $spcharge = DB::table('shippingcharges')
            ->select('shippingcharges.id as id','shippingcharges.weight as weight')
            ->get();

            return view('branch.billing.edit',compact('billing','spcharge'));

        }else{
            // return redirect('/')->with('toast_error','You are not Authorized');
            Alert::error('You are not Authorized', 'You do not have access to this function');
            return Redirect::back();
        }
    }

    public function update(Request $request, $billing){
        $bill = New Billing;
        $bill = Billing::find($billing);
        $bill->shippingcharge_id = $request->spchargeid;
        $bill->order_id = $request->cpxid;
        $bill->shippingcharge = $request->spcharge;
        $bill->productprice = $request->prdprice;
        $bill->dutytax = $request->dutax;
        $bill->nettotal = $request->ntotal;
        $bill->paymentstatus = $request->paystatus;
        $bill->updatedby = Auth::id();
        $bill->save();

        return redirect(route('branch.billing.index'))->with('toast_success','Bill Updated');
    }

    public function billentry($request){
        if (Gate::allows('finance-only', Auth::user())){
            $billing = DB::table('billings')
            ->where('id', $request)
            ->first();

            $spcharge = New Shippingcharge;
            // $spcharge = Shippingcharge::all();
            $spcharge = DB::table('shippingcharges')
                ->select('shippingcharges.id as id','shippingcharges.weight as weight')
                ->get();

            return view('branch.billing.entry',compact('billing','spcharge'));

        }else{
            // return redirect('/')->with('toast_error','You are not Authorized');
            Alert::error('You are not Authorized', 'You do not have access to this function');
            return Redirect::back();
        }
    }

    public function destroy(Billing $billing){
        //
    }
}
