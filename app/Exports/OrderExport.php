<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// class OrderExport implements FromCollection{
//     public function collection()
//     {
//         return Order::all();
//     }
// }

class OrderExport implements FromView {


    public function view(): View{

        $from_date = Carbon::parse(request()->input('from_date'))->startOfDay();
        $to_date = Carbon::parse(request()->input('to_date'))->endOfDay();

        // $from_date = request()->input('from_date') ;
        // $to_date   = request()->input('to_date') ;

        $ord = DB::table('orders')
            ->whereBetween('created_at', [ $from_date, $to_date ] )
            ->get();

        return view('admin.report.ordertbl', [
            'ord' => $ord
        ]);
    }

}
