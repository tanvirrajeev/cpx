@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">
            <div class="card">

                {{-- Validation Error Message --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-header bg-navy"><h3>{{ __('CREATE STATUS') }}</h3>
                    <a href="{{route('admin.status.index')}}" class="btn btn-outline-warning btn-sm float-right"><i class="fas fa-backward"></i>&nbsp;</i>BACK</a>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.status.store') }}" method="POST">
                        {{-- <form action="{{ route('order.store') }}" method="POST"> --}}
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="name">STATUS</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="name" name="name" style="text-transform: uppercase"  placeholder="Status" required autocomplete="off" autofocus>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="flag">FIELD</label><label class="text-danger">*</label>
                                    <select class="form-control form-control-sm" name="flag" id="flag" required>
                                            <option value="" selected disabled>SELECT</option>
                                            <option value="1">AWB</option>
                                            <option value="2">NOTE</option>
                                            <option value="3">N/A</option>
                                    </select>
                                    <small>You will get this field prompt while updating the status from Dashboard. If you don't want any field to popup. Please select N/A. </small>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark" id="submit_button" >CREATE</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
