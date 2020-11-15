<?php

namespace App\DataTables;

// use App\App\OrderDataTable;
// use OrderDataTable;
use App\DataTables\OrderDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Order;
use Illuminate\Support\Facades\DB;

class OrderDataTable extends DataTable
{

    public function dataTable($query){
        return datatables()
            ->eloquent($query);
    }


    public function query(OrderDataTable $model){
        // $from = date('2020-11-10 00:00:00');
        // $to = date('2020-11-11 23:59:59');
        // $data = Order::where('created_at', '2020-11-11 22:03:13');
        // $data = Order::select();
        $data = Order::query()
            // ->whereBetween('created_at', ['2020-11-10 00:00:00', '2020-11-11 23:59:59'])
            ->whereBetween('created_at', [$this->from, $this->to])
            ->select([
                'orders.id',
                'orders.ecomordid',
                'orders.status_id',
                'orders.awb',
                'orders.created_at'
            ]);
        return $this->applyScopes($data);
    }


    public function html(){
        return $this->builder()
                    ->setTableId('orderdatatable-table')
                    // ->columns($this->getColumns())
                    ->columns([
                        'id' => [ 'title' => 'SHIPPING CODE' ],
                        'ecomordid' => [ 'title' => 'ECOM ORDER' ],
                        'status_id' => [ 'title' => 'STATUS' ],
                        'awb' => [ 'title' => 'AWB' ],
                        'created_at' => [ 'title' => 'DATE' ],
                    ])
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['excel', 'print', 'reset', 'reload'],
                        'initComplete' => "function () {
                            this.api().columns([0,3]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                    ]);
    }


    protected function getColumns(){
        return [
            Column::make('id'),
            Column::make('ecomordid'),
            Column::make('status_id'),
            Column::make('awb'),
            Column::make('created_at'),
        ];
    }


    protected function filename(){
        return 'Order_' . date('YmdHis');
    }
}
