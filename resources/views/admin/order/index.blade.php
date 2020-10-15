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



@endsection
