@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-orange"><h3>{{ __('Orders') }}</h3></div>

                <div class="card-body">
                    <table class="table border" id="orderlistadmin">
                        <thead>
                            <th>SHIPPING CODE</th>
                            <th>ECOM ORD NO</th>
                            <th>CONSIGNEE NAME</th>
                            <th>STATUS</th>
                            <th>NOTE</th>
                            <th>CREATED AT</th>
                            <th>AWB</th>
                            <th>ACTION</th>
                        </thead>

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
        ajax: '{!! route('branch.order.orderlist') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'ecomordid', name: 'ecomordid' },
            { data: 'consigneename', name: 'consigneename' },
            { data: 'statusname', name: 'statuses.name' },
            { data: 'note', name: 'note' },
            { data: 'created_at', name: 'created_at' },
            { data: 'awb', name: 'awb' },
            { data: 'action', name: 'action' }

        ]
    });
} );
</script>

@endsection
