@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Order Now') }}</div>

                <div class="card-body">

                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ecomordida">Ecommerce Order No</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="ecomordida" name="ecomordida" placeholder="Order id given by E-Commerce" value="{{ old('ecomordida') }}" required autocomplete="ecomordida" autofocus>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ecomnames">E-Commerce Company Name</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="ecomnames" name="ecomnames" placeholder="Amazone, Flipkart etc." value="{{ old('ecomnames') }}" required autocomplete="ecomnames">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ecomproddescd">Product Description</label><label class="text-danger">*</label>
                            <textarea class="form-control" id="ecomproddescd" name="ecomproddescd" placeholder="Describe your product" value="{{ old('ecomproddescd') }}" required autocomplete="ecomproddescd"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="ecomsppngpriorityq">Product Shipping Priority</label>
                                    <select class="form-control form-control-sm" name="ecomsppngpriorityq" id="ecomsppngpriorityq">
                                        <option value="Normal" selected>Normal</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">

                            </div>
                            <div class="col-5">
                                <label for="ecomorddtt">E-Commerce Order Date</label><label class="text-danger">*</label>
                              {{-- <i class="fa fa-calendar-alt"></i> --}}
                              {{-- <input type="text" class="datetimepicker" name="ecomorddtt" id="ecomorddtt" autocomplete="off" required> --}}
                              <input type="text" name="ecomorddtt" id="ecomorddtt" autocomplete="off" required>
                              {{-- <i class="fa fa-calendar-alt"></i> --}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="consigneenamer">Consignee Name</label><label class="text-danger">*</label>
                            <input type="text" class="form-control" id="consigneenamer" name="consigneenamer" placeholder="Receiver's Name" value="{{ old('consigneenamer') }}" required autocomplete="consigneenamer">
                        </div>

                        <div class="form-group">
                            <label for="consigneeaddrsf">Consignee Address</label><label class="text-danger">*</label>
                            <textarea class="form-control" id="consigneeaddrsf" name="consigneeaddrsf" placeholder="CPX Destination" value="{{ old('consigneeaddrsf') }}" required autocomplete="consigneeaddrsf"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="ecomprdtraclnke">E-Commerce Tracking Link</label>
                            <input type="text" class="form-control" id="ecomprdtraclnke" name="ecomprdtraclnke" placeholder="E-Commerce Tracking Link if Available" value="{{ old('consigneenamer') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>


                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Previous Orders') }}</div>

                <div class="card-body">


                    <table class="table border" id="myTable">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
