@extends('layouts.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header bg-orange"><h3>{{ __('Update By AWB') }}</h3></div>
                <div class="card-body">

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-5">Total Records - <b><span id="total_records"></span></b></div>
                                <div class="col-md-5">
                                 <div class="input-group input-daterange">
                                     <input type="text" name="from_date" id="from_date"  class="form-control" />
                                     &nbsp;<div class="input-group-addon">To</div>&nbsp;
                                     <input type="text"  name="to_date" id="to_date"  class="form-control" />
                                 </div>
                                </div>
                                <div class="col-md-2">
                                 <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
                                 <button type="button" name="refresh" id="refresh" class="btn btn-success btn-sm">Refresh</button>
                                </div>
                               </div>

                        </div>


                    <div class="table-responsive">
                        <div class="panel panel-default">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                {!! $dataTable->table([], true) !!}
                                {!! $dataTable->scripts() !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    // $(document).ready( function () {
    //     from_date = date('2020-01-01 00:00:00');
    //     to_date = Date.now();
    //     $.ajax({
    //         url: "{{ url('/admin/searchorder') }}",
    //         method:"POST",
    //         data:{_token: CSRF_TOKEN, from_date:from_date, to_date:to_date},
    //         // dataType:"json",
    //         success:function(data){
    //             console.log(data);
    //         }
    //     })
    // });

    // $('#filter').click(function() {
        $(document).ready( function () {
        // from_date = date('2020-01-01 00:00:00');
        // to_date = Date.now();
        // $('#orderdatatable-table').dataTable().fnDestroy();
        fetch_data();


        function fetch_data(from_date = '', to_date = ''){
            // location.reload();
            // $('#orderdatatable-table').empty();
            // $('#orderdatatable-table').dataTable().fnDestroy();

            $.ajax({
                url:"{{ url('/admin/searchorder') }}",
                method:"POST",
                data:{_token: CSRF_TOKEN,from_date:from_date, to_date:to_date},
                // dataType:"json",
                success:function(data){
                    console.log(data);
                }
            })
        }

        $('#filter').click(function(){
        // $('#orderdatatable-table').dataTable().fnDestroy();
        // $('#orderdatatable-table').clear();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if(from_date != '' &&  to_date != '')
        {
        fetch_data(from_date, to_date);
        }
        else
        {
        alert('Both Date is required');
        }
        });

        $('#refresh').click(function(){
        $('#from_date').val('');
        $('#to_date').val('');
        fetch_data();
        });





    });

</script>


@endsection




