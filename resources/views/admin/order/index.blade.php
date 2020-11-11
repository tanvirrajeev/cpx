@extends('layouts.master')

@section('content')
<div class="container">

    {{-- Status progress modal --}}
    <link href="{{ asset('css/progress-wizard.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vertical-bar.css') }}" rel="stylesheet">
    @include('admin.status.tracking')
    {{-- Change Status Modal  --}}
    @include('admin.status.chgstatusmodal')
    {{-- Show CPX Details  --}}
    @include('admin.status.cpx')
    @include('admin.status.history')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-orange"><h3>{{ __('Orders') }}</h3></div>
                <div class="card-body">
                    <table class="table border" id="orderlistadmin">
                        <thead>
                            <th>SHIPPING CODE</th>
                            <th>ECOM ORD NO</th>
                            {{-- <th>CONSIGNEE NAME</th> --}}
                            <th>STATUS</th>
                            <th>AWB</th>
                            <th>CREATED AT</th>
                            <th>ACTION</th>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>SHIPPING CODE</th>
                                <th>ECOM ORD NO</th>
                                <th>CONSIGNEE NAME</th>
                                <th>STATUS</th>
                                <th>NOTE</th>
                                <th>CREATED AT</th>
                                <th>AWB</th>
                                <th>ACTION</th>
                            </tr>
                        </tfoot> --}}

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- DataTalbe for Admin Order page --}}
<script>
    $(document).ready( function () {
    $('#orderlistadmin').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [0, 'desc'],
        ajax: '{!! route('admin.order.orderlist') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'ecomordid', name: 'ecomordid' },
            // { data: 'consigneename', name: 'consigneename' },
            { data: 'statusname', name: 'statuses.name' },
            { data: 'awb', name: 'awb' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' }

        ] //,
        // initComplete: function () {
        //     this.api().columns().every(function () {
        //     var column = this;
        //     var input = document.createElement("input");
        //     $(input).appendTo($(column.footer()).empty())
        //     .on('change', function () {
        //         column.search($(this).val(), false, false, true).draw();
        //         });
        //     });
        // }

    });
} );
</script>


@endsection


