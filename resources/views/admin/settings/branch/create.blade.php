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

                <div class="card-header bg-navy"><h3>{{ __('CREATE BRANCH') }}</h3>
                    <a href="/admin/branch/" class="btn btn-outline-warning btn-sm float-right"><i class="fas fa-backward"></i>&nbsp;</i>BACK</a>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.branch.store') }}" method="POST">
                        {{-- <form action="{{ route('order.store') }}" method="POST"> --}}
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">NAME</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Branch Nane" required autocomplete="off" autofocus>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="location">LOCATION</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Location name" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="address">ADDRESS</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" required autocomplete="off" autofocus>
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
