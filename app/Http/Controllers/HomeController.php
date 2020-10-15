<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        // $user = User::all();
        return view('home');
    }

    public function userlist(){
        $data = DB::table('users')->get();
        // $user = User::all();
        // var_dump($data);
        return Datatables::of($data) //Branch::query()
        ->addColumn('action', function( $data) {
            return  '<a href="branch/'.$data->id.'/edit" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i><i class="fas fa-edit"></i></a>
            <button class="btn btn-xs btn-danger btn-delete" data-remote="/branch/'. $data->id . '"><i class="fas fa-trash-alt"></i></button>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(Request $request){

        // $ord = New Order;
        // $ord->users_id = Auth::id();
        // $ord->ecomordid = $request->ecomordida;
        // $ord->ecomname = $request->ecomnames;
        // $ord->ecomproddesc = $request->ecomproddescd;
        // $ord->ecomorddt = $request->ecomorddtt;
        // $ord->consigneename = $request->consigneenamer;
        // $ord->consigneeaddrs = $request->consigneeaddrsf;
        // $ord->ecomprdtraclnk = $request->ecomprdtraclnke;
        // $ord->ecomsppngpriority = $request->ecomorddtt;
        // $ord->ecomstatus = 'Not Received';
        // $ord->save();

        // return redirect(route('home.index'));
        // return redirect(route('supplier.index'))->with('toast_success','Supplier Created');

    }


}
