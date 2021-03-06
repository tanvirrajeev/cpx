@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-orange"><h3>{{ __('Billing') }}</h3></div>

                <div class="card-body">
                    <table class="table border" id="orderlistadmin">
                        <thead>
                            <th>SHIPPING CODE</th>
                            <th>NET TOTAL</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                            <th>ENTRY</th>
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
        ajax: '{!! route('branch.billing.billinglist') !!}',
        columns: [
            { data: 'order_id', name: 'order_id' },
            { data: 'nettotal', name: 'nettotal' },
            { data: 'paymentstatus', name: 'paymentstatus' },
            { data: 'action1', name: 'action1' },
            { data: 'action2', name: 'action2' }
        ],
        rowCallback: function(row, data, index) {
                    if (data.paymentstatus == "PAYED"){
                        $('td:eq(4)', row).replaceWith("<td><button href=\"#\" class=\"btn btn-xs btn-primary\" disabled>ENTRY</button><td>");
                        }

                    if (data.paymentstatus == "PAYED"){
                        $('td:eq(2)', row).css('background-color','#4BBF28');
                        }
                        else{
                            $('td:eq(2)', row).css('background-color','#BF2828');
                            }
                    }
    });
} );
</script>

@endsection
