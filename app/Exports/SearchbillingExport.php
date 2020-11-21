<?php

namespace App\Exports;

use App\Billing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SearchbillingExport implements FromCollection, WithHeadings, ShouldAutoSize{

    public function collection(){

        $from_date = Carbon::parse(request()->input('from_date'))->startOfDay();
        $to_date = Carbon::parse(request()->input('to_date'))->endOfDay();

        $bil = DB::table('billings')
            ->select('billings.id', 'billings.shippingcharge', 'billings.productprice', 'billings.dutytax', 'billings.nettotal', 'billings.paymentstatus', 'billings.created_at')
            ->whereBetween('billings.created_at', [ $from_date, $to_date ] )
            ->get();

        // return view('admin.search.searchbillingdate', [
        //     'bil' => $bil
        // ]);

        // return Billing::all();
        return $bil;
    }


    public function headings(): array
    {
        return [
            'SHIPPING CODE',
            'SHIPPING($)',
            'PRODUCT($)',
            'DUTYTAX($)',
            'NET TOTAL($)',
            'PAYMENT',
            'CREATED AT',
        ];
    }


}
