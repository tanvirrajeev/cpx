<?php



namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use App\Billing;
use App\Shippingcharge;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BillingController extends Controller
{

    public function index()
    {
        return view('billing.index');
    }

    public function billinglist(){
        $data = DB::table('billings')
                ->get();
        // $user = User::all();
        // var_dump($data);
        return Datatables::of($data)
        ->addColumn('action1', function( $data) {
            return  '<a href="/admin/billing/'.$data->id.'" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
            <a href="/admin/billing/'.$data->id.'/edit" class="btn btn-xs btn-danger"><i class="fas fa-edit"></i></a>';
        })
        ->addColumn('action2', function( $data) {
            return  '<a href="/admin/billing/'.$data->id.'/entry" class="btn btn-xs btn-primary">ENTRY</a>';
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

    public function show(Billing $billing)
    {
        //
    }

    public function edit(Billing $billing)
    {
        // $spcharge = New Shippingcharge;
        // $spcharge = Shippingcharge::all();
        $spcharge = DB::table('shippingcharges')
            ->select('shippingcharges.id as id','shippingcharges.weight as weight')
            ->get();
        // dd($billing);
        // dd($spcharge);
        // $status = Status::all();
        // var_dump($status);
        return view('billing.edit',compact('billing','spcharge'));
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

        return redirect(route('admin.billing.index'))->with('toast_success','Bill Updated');
    }

    public function billentry($request){
        $billing = DB::table('billings')
            ->where('id', $request)
            ->first();
        $spcharge = New Shippingcharge;
        // $spcharge = Shippingcharge::all();
        $spcharge = DB::table('shippingcharges')
            ->select('shippingcharges.id as id','shippingcharges.weight as weight')
            ->get();
        // dd($billing);
        // dd($spcharge);
        // $status = Status::all();
        // var_dump($status);
        return view('billing.entry',compact('billing','spcharge'));
    }

    // public function billupdate(Request $request, $billing){
    //     $bill = New Billing;
    //     $bill = Billing::find($billing);
    //     $bill->shippingcharge_id = $request->spchargeid;
    //     $bill->order_id = $request->cpxid;
    //     $bill->shippingcharge = $request->spcharge;
    //     $bill->productprice = $request->prdprice;
    //     $bill->dutytax = $request->dutax;
    //     $bill->nettotal = $request->ntotal;
    //     $bill->paymentstatus = $request->paystatus;
    //     $bill->save();

    //     return redirect(route('admin.billing.index'))->with('toast_success','Bill Updated');
    // }

    public function destroy(Billing $billing){
        //
    }
}
