@extends('layouts.master')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-orange"><h3>{{ __('Orders') }}</h3></div>
                <div class="card-body">

                    <form method="get" action="{{ route('admin.orderexport.orderexport_view') }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">Total Records - <b><span id="total_records"></span></b></div>
                                <div class="col-md-5">
                                <div class="input-group input-daterange">
                                    <input type="text" name="from_date" id="from_date"  class="form-control" autocomplete="off" />
                                    &nbsp;<div class="input-group-addon">To</div>&nbsp;
                                    <input type="text"  name="to_date" id="to_date"  class="form-control" autocomplete="off" />
                                </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" name="filter" id="filter" class="btn bg-maroon btn-sm">Filter</button>
                                    <button type="submit" name="export" id="export" class="btn bg-purple btn-sm">Export</button>
                                {{-- <a href="{{ route('admin.orderexport.orderexport_view')}}" class="btn btn-dark btn-sm">Export</a> --}}
                                </div>
                            </div>
                        </div>
                    </form>


                    <table class="table border" id="ordersearch">
                        <thead>
                                <th>SHIPPING CODE</th>
                                <th>ECOM ORD NO</th>
                                {{-- <th>CONSIGNEE NAME</th> --}}
                                <th>STATUS</th>
                                <th>AWB</th>
                                <th>CREATED AT</th>
                                {{-- <th>ACTION</th> --}}
                        </thead>
                        <tfoot>
                            <tr>
                                <th>SHIPPING CODE</th>
                                <th>ECOM ORD NO</th>
                                {{-- <th>CONSIGNEE NAME</th> --}}
                                <th>STATUS</th>
                                {{-- <th>NOTE</th> --}}
                                <th>AWB</th>
                                <th>CREATED AT</th>
                                {{-- <th>ACTION</th> --}}
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
     $('.input-daterange').datepicker({
      todayBtn:'linked',
      format:'yyyy-mm-dd',
      autoclose:true
     });

     load_data();

     function load_data(from_date = '', to_date = ''){
      $('#ordersearch').DataTable({
       processing: true,
       serverSide: true,
    //    bDestroy: true,
       responsive: true,
       order: [0, 'desc'],
       ajax: {
        url:'{{ route("admin.search.searchorderdate") }}',
        data:{from_date:from_date, to_date:to_date}
       },
       columns: [
            { data: 'id', name: 'id' },
            { data: 'ecomordid', name: 'ecomordid' },
            // { data: 'consigneename', name: 'consigneename' },
            { data: 'statusname', name: 'statusname' },
            { data: 'awb', name: 'awb' },
            { data: 'created_at', name: 'created_at' }
            // { data: 'action', name: 'action' }

        ],
        initComplete: function () {
            this.api().columns([0,1]).every(function () {
            var column = this;
            var input = document.createElement("input");
            $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
                });
            });
        }
      });
     }

     $('#filter').click(function(){
      var from_date = $('#from_date').val();
      console.log(from_date);
      var to_date = $('#to_date').val();
      console.log(to_date);
      if(from_date != '' &&  to_date != ''){
        $('#ordersearch').DataTable().destroy();
        console.log('load_data function calling...');
        load_data(from_date, to_date);
      }
      else
      {
       alert('Both Date is required');
      }
     });

     $('#refresh').click(function(){
      $('#from_date').val('');
      $('#to_date').val('');
      $('#ordersearch').DataTable().destroy();
      load_data();
     });

    });
    </script>


@endsection

