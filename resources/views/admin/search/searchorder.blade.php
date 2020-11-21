@extends('layouts.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header bg-orange"><h3>{{ __('SEARRCH ORDERS') }}</h3></div>
                <div class="card-body">

                    <div class="table-responsive">
                        <div class="panel panel-default">
                            <div class="panel-heading"></div>
                            <div class="panel-body" id="equictntbl">
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
@endsection




