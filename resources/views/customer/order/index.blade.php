@extends('layouts.master')

@section('content')
<div class="container">
    {{-- Status progress modal --}}
    <link href="{{ asset('css/progress-wizard.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vertical-bar.css') }}" rel="stylesheet">
    @include('customer.status.order-created')
    @include('customer.status.received-at-hub')
    @include('customer.status.destination-hub')
    @include('customer.status.delivered')
    {{-- !!Status progress modal --}}
    <div class="row">
        <div>

        </div>
    </div>

    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-orange"><h3>{{ __('Orders') }}</h3></div>

                <div class="card-body">
                    <table class="table border" id="orderlist">
                        <thead>
                            <th>SHIPPING CODE</th>
                            <th>ECOM ORD NO</th>
                            <th>CONSIGNEE NAME</th>
                            <th>STATUS</th>
                            <th>AWB</th>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- DataTable for Customer Order Page --}}
<script>
    $(document).ready( function () {
    $('#orderlist').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [0, 'desc'],
        ajax: '{!! route('customer.order.orderlist') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'ecomordid', name: 'ecomordid' },
            { data: 'consigneename', name: 'consigneename' },
            { data: 'statusname', name: 'statuses.name' },
            { data: 'awb', name: 'awb' }
        ]
    });
} );
</script>

@endsection
