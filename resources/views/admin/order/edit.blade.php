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

                <div class="card-header bg-dark"><h3>{{ __('Order Now') }}</h3></div>

                <div class="card-body bg-orange">

                    <form action="/admin/order/{{ $order->id}}" method="POST" id="orderform">
                        {{-- <form action="{{ route('order.store') }}" method="POST"> --}}
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ecomordida">PRODUCT ORDER NO</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="ecomordida" name="ecomordid" value="{{$order->ecomordid}}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ecomnames">PRODUCT ORDERED FROM</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="ecomnames" name="ecomname" value="{{$order->ecomname}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ecomproddescd">PRODUCT DESCRIPTION</label><label class="text-danger">*</label>
                            <textarea class="form-control" id="ecomproddescd" name="ecomproddesc">{{$order->ecomproddesc}}</textarea>
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
                                <input type="text" class="form-control" name="ecomorddt" id="ecomorddtt" autocomplete="off" value="{{$order->ecomorddt}}"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                              </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="consigneenamer">CONSIGNEE NAME</label><label class="text-danger">*</label>
                            <input type="text" class="form-control" id="consigneenamer" name="consigneename" value="{{$order->consigneename}}">
                        </div>

                        <div class="form-group">
                            <label for="consigneeaddrsf">CONSIGNEE ADDRESS</label><label class="text-danger">*</label>
                            <textarea class="form-control" id="consigneeaddrsf" name="consigneeaddrs">{{$order->consigneeaddrs}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="ecomprdtraclnke">PRODUCT TRACKING LINK (IF AVAILABLE)</label>
                            <input type="text" class="form-control" id="ecomprdtraclnke" name="ecomprdtraclnke" value="{{$order->ecomprdtraclnk}}">
                        </div>

                        <div class="form-group">
                            <label for="ecomstatuss">STATUS</label>
                            <select class="form-control form-control-sm" name="ecomstatuss" id="ecomstatuss">
                                <option value="{{$order->status->id}}" selected>{{$order->status->name}}</option>
                                @foreach ($status as $item)
                                    @if ($order->status_id  !== $item->id)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" id="note" name="note" rows="3" style="display:none" placeholder="Must fillup...">{{$order->note}}</textarea>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="awbd" name="awbd" value="{{$order->awb}}" style="display:none" placeholder="Insert AWB...">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="rcvby" name="rcvby" value="{{$order->ecomrcvby}}" style="display:none" placeholder="Receiver's Name">
                        </div>

                        <button type="submit" class="btn btn-warning" id="submit_button">UPDATE</button>
                      </form>


                </div>
            </div>
        </div>
    </div>
</div>


{{-- On Admin Order Edit when select status as ARRIVED/OTHERS etc --}}
<script>
    jQuery(document).ready(function(){
      $("#ecomstatuss").change(function() {

        var selectedstatus = $(this).val();
        // console.log(selectedstatus);

        $.ajax({
          type: 'get',
          url: "{{ url('/admin/statuslist') }}",
          data: {selectedstatus:selectedstatus},
          success:function(data){
            // console.log(data)
            var st = $('#orderform');
            if(data == '1'){
                st.find('#awbd').show();
                st.find('#awbd').prop('required',true);
                st.find('#note').hide();
                st.find('#note').prop('required',false);
                st.find('#rcvby').hide();
                st.find('#rcvby').prop('required',false);
            }else if(data == '2'){
                st.find('#note').show();
                st.find('#note').prop('required',true);
                st.find('#awbd').hide();
                st.find('#awbd').prop('required',false);
                st.find('#rcvby').hide();
                st.find('#rcvby').prop('required',false);
            }else if(data == '99'){
                st.find('#rcvby').show();
                st.find('#rcvby').prop('required',true);
                st.find('#awbd').hide();
                st.find('#awbd').prop('required',false);
                st.find('#note').hide();
                st.find('#note').prop('required',false);
            }else{
                st.find('#note').hide();
                st.find('#awbd').hide();
                st.find('#note').prop('required',false);
                st.find('#awbd').prop('required',false);
            }
          }
      })
      });
    });
  </script>

@endsection
