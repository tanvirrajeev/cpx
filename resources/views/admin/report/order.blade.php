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
                                    <input type="text" name="from_date" id="from_date"  class="form-control" />
                                    &nbsp;<div class="input-group-addon">To</div>&nbsp;
                                    <input type="text"  name="to_date" id="to_date"  class="form-control" />
                                </div>
                                </div>
                                <div class="col-md-3">
                                <button type="submit" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
                                <button type="button" name="refresh" id="refresh" class="btn btn-success btn-sm">Refresh</button>
                                <a href="{{ route('admin.orderexport.orderexport_view')}}" class="btn btn-dark btn-sm">Export</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    @include('admin.report.ordertbl', $ord)
                    {{ $ord->links() }}

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

