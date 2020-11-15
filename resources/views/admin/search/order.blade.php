@extends('layouts.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header bg-orange"><h3>{{ __('Update By AWB') }}</h3></div>
                <div class="card-body">

                    <form action="/admin/searchorder/" method="get">
                        {{-- @csrf --}}
                        {{-- @method('PUT') --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label for="from">From</label>
                                    <input class="form-control" type="text" id="from" name="from" />
                                </div>
                                <div class="col-4">
                                    <label for="from">To</label>
                                    <input class="form-control" type="text" id="to" name="to" />
                                </div>
                                <button type="submit" class="btn btn-dark btn-sm" id="submit_button">SEARCH</button>
                            </div>
                        </div>
                    </form>


                    <div class="table-responsive">
                        <div class="panel panel-default">
                            <div class="panel-heading">Sample Data</div>
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
@endsection




