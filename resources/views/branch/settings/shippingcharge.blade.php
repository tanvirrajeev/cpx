@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-dark"><h3>{{ __('GENERATE SHIPPING CHARGE') }}</h3></div>

                <div class="card-body bg-orange">

                    <form action="{{ route('branch.shippingcharge.store') }}" method="POST">
                        {{-- <form action="{{ route('order.store') }}" method="POST"> --}}
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="weights">MIN WEIGHT (KG)</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="weights" name="weights" placeholder="i.e 0.5" required autofocus>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="rates">RATE ($)</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="rates" name="rates" placeholder="i.e. 3.5" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="mweights">MAX WEIGHT (KG)</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="mweights" name="mweights" placeholder="i.e 30" required autofocus>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark" id="submit_button" >GENERATE</button>
                      </form>
                </div>
            </div>
        </div>



        {{-- Datatables  --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark"><h3>{{ __('SHIPPING CHARGE') }}</h3></div>
                <div class="card-body">
                    <table class="table border" id="shippingcharge">
                        <thead>
                                <th>RATE ($)</th>
                                <th>WEIGHT (KG)</th>
                                <th>CHARGES ($)</th>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready( function () {
    $('#shippingcharge').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [1, 'asc'],
        ajax: '{!! route('branch.shipping.shippingchargelist') !!}',
        columns: [
            { data: 'rate', name: 'rate' },
            { data: 'weight', name: 'weight' },
            { data: 'amount', name: 'amount' }
        ]
    });
});
</script>

@endsection
