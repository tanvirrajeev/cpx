@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-dark"><h3>{{ __('Order Now') }}</h3></div>

                <div class="card-body bg-orange">

                    <form action="/admin/order/{{ $order->id}}" method="POST">
                        {{-- <form action="{{ route('order.store') }}" method="POST"> --}}
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ecomordida">PRODUCT ORDER NO</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="ecomordida" name="ecomordida" value="{{$order->ecomordid}}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ecomnames">PRODUCT ORDERED FROM</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="ecomnames" name="ecomnames" value="{{$order->ecomname}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ecomproddescd">PRODUCT DESCRIPTION</label><label class="text-danger">*</label>
                            <textarea class="form-control" id="ecomproddescd" name="ecomproddescd">{{$order->ecomproddesc}}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="ecomsppngpriorityq">PRODUCT SHIPPING PRIORITY</label>
                                    <select class="form-control form-control-sm" name="ecomsppngpriorityq" id="ecomsppngpriorityq">
                                        <option value="{{$order->ecomsppngpriority}}" selected>{{$order->ecomsppngpriority}}</option>
                                        <option value="NORMAL">NORMAL</option>
                                        <option value="HIGH">HIGH</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="ecompurchaseamto">PRODUCT PRICE</label><label class="text-danger">*</label>
                                <input type="text" class="form-control" id="ecompurchaseamto" name="ecompurchaseamto" value="{{$order->ecompurchaseamt}}">
                            </div>
                            <div class="col-5">
                                <label for="ecomorddtt">DATE OF THE PRODUCT ORDERED</label><label class="text-danger">*</label>
                              <i class="fa fa-calendar-alt"></i>
                              <div class="input-group date" id="datetimepicker2">
                                <input type="text" class="form-control" name="ecomorddtt" id="ecomorddtt" autocomplete="off" value="{{$order->ecomorddt}}"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                              </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="consigneenamer">CONSIGNEE NAME</label><label class="text-danger">*</label>
                            <input type="text" class="form-control" id="consigneenamer" name="consigneenamer" value="{{$order->consigneename}}">
                        </div>

                        <div class="form-group">
                            <label for="consigneeaddrsf">CONSIGNEE ADDRESS</label><label class="text-danger">*</label>
                            <textarea class="form-control" id="consigneeaddrsf" name="consigneeaddrsf">{{$order->consigneeaddrs}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="ecomprdtraclnke">PRODUCT TRACKING LINK (IF AVAILABLE)</label>
                            <input type="text" class="form-control" id="ecomprdtraclnke" name="ecomprdtraclnke" value="{{$order->ecomprdtraclnk}}">
                        </div>

                        <div class="form-group">
                            <label for="ecomstatuss">STATUS</label>
                            <select class="form-control form-control-sm" name="ecomstatuss" id="ecomstatuss">
                                <option value="{{$order->ecomstatus}}" selected>{{$order->ecomstatus}}</option>
                                <option value="ARRIVED">ARRIVED</option>
                                <option value="NOT ARRIVED">NOT ARRIVED</option>
                                <option value="OTHERS">OTHERS</option>
                            </select>
                        </div>

                        <div class="form-group">
                            {{-- <label for="note">NOTE</label> --}}
                            <textarea class="form-control" id="note" name="note" rows="3" style="display:none" placeholder="Must fillup if you select status as OTHERS...">{{$order->note}}</textarea>
                        </div>

                        <div class="form-group">
                            {{-- <label for="ecomprdtraclnke">PRODUCT TRACKING LINK (IF AVAILABLE)</label> --}}
                            <input type="text" class="form-control" id="awbd" name="awbd" value="{{$order->awb}}" style="display:none" placeholder="Insert AWB...">
                        </div>

                        <button type="submit" class="btn btn-dark" id="submit_button">UPDATE</button>
                      </form>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection
