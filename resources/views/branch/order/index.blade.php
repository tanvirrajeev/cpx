@extends('layouts.master')

@section('content')
<div class="container">

    {{-- Status progress modal --}}
    <link href="{{ asset('css/progress-wizard.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vertical-bar.css') }}" rel="stylesheet">
    @include('branch.status.tracking')
    {{-- Change Status Modal  --}}
    @include('branch.status.chgstatusmodal')
    {{-- Show CPX Details  --}}
    @include('branch.status.cpx')
    @include('branch.status.history')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-orange"><h3>{{ __('Orders') }}</h3></div>
                <div class="card-body">
                    <table class="table border" id="orderlistadmin">
                        <thead>
                                <th>SHIPPING CODE</th>
                                <th>ECOM ORD NO</th>
                                <th>STATUS</th>
                                <th>AWB</th>
                                <th>CREATED AT</th>
                                <th>ACTION</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>SHIPPING CODE</th>
                                <th>ECOM ORD NO</th>
                                <th>STATUS</th>
                                <th>AWB</th>
                                <th>CREATED AT</th>
                                <th width="170px">ACTION</th>
                            </tr>
                        </tfoot>

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
        // columnDefs: [{ "orderable": false, "targets": '_all' }],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'ecomordid', name: 'ecomordid' },
            // { data: 'consigneename', name: 'consigneename' },
            { data: 'statusname', name: 'statusname' },
            { data: 'awb', name: 'awb' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' }
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
});
</script>
@endsection

