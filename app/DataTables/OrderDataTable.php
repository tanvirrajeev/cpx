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
        $data = Order::query()
            ->join('statuses', 'statuses.id', '=', 'orders.status_id')
            ->select([
                'orders.id',
                'orders.ecomordid',
                'statuses.name as statusname',
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
                        'statusname' => [ 'title' => 'STATUS' ],
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
                            this.api().columns([0,1,3,4]).every(function () {
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
            Column::make('statusname'),
            Column::make('awb'),
            Column::make('created_at'),
        ];
    }


    protected function filename(){
        return 'Order_' . date('YmdHis');
    }
}
