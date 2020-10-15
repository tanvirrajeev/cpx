@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-dark"><h3>{{ __('Order Now') }}</h3></div>

                <div class="card-body bg-orange">

                    <form>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ecomordida">PRODUCT ORDER NO</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="ecomordida" name="ecomordida" value="{{$ord->ecomordid}}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ecomnames">PRODUCT ORDERED FROM</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="ecomnames" name="ecomnames" value="{{$ord->ecomname}}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ecomproddescd">PRODUCT DESCRIPTION</label><label class="text-danger">*</label>
                            <textarea class="form-control" id="ecomproddescd" name="ecomproddescd" disabled>{{$ord->ecomproddesc}}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="ecomsppngpriorityq">PRODUCT SHIPPING PRIORITY</label>
                                    <input type="text" class="form-control" id="ecomsppngpriorityq" name="ecomsppngpriorityq" value="{{$ord->ecomsppngpriority}}" disabled>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="ecompurchaseamto">PRODUCT PRICE</label><label class="text-danger">*</label>
                                <input type="text" class="form-control" id="ecompurchaseamto" name="ecompurchaseamto" value="{{$ord->ecompurchaseamt}}" disabled>
                            </div>
                            <div class="col-5">
                                <label for="ecomorddtt">DATE OF THE PRODUCT ORDERED</label><label class="text-danger">*</label>
                              <i class="fa fa-calendar-alt"></i>
                              <input type="text" class="form-control" name="ecomorddtt" id="ecomorddtt" value="{{$ord->ecomorddt}}" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="consigneenamer">CONSIGNEE NAME</label><label class="text-danger">*</label>
                            <input type="text" class="form-control" id="consigneenamer" name="consigneenamer" value="{{$ord->consigneename}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="consigneeaddrsf">CONSIGNEE ADDRESS</label><label class="text-danger">*</label>
                            <textarea class="form-control" id="consigneeaddrsf" name="consigneeaddrsf" disabled>{{$ord->consigneeaddrs}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="ecomprdtraclnke">PRODUCT TRACKING LINK (IF AVAILABLE)</label>
                            <input type="text" class="form-control" id="ecomprdtraclnke" name="ecomprdtraclnke" value="{{$ord->ecomprdtraclnk}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="note">NOTE</label>
                            <textarea class="form-control" id="note" name="note" disabled>{{$ord->note}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="ecomstatuss">STATUS</label>
                            <select class="form-control form-control-sm" name="ecomstatuss" id="ecomstatuss">
                                <option value="{{$ord->ecomstatus}}" selected>{{$ord->ecomstatus}}</option>
                            </select>
                        </div>

                      </form>

                      <a href="/admin/dashboard" class="btn btn-warning">Back </a>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
