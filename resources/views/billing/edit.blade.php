@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-dark"><h3>{{ __('Billing') }}</h3></div>

                <div class="card-body bg-orange">

                    <form action="/admin/billing/{{$billing->id}}" method="POST" id="billingform">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cpxid">CPX SHIPPING ID</label>
                                    <input type="text" class="form-control" id="cpxid" name="cpxid" value="{{$billing->order_id}}" readonly>
                                </div>
                            </div>
                            <div class="col-6">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="spchargeid">SHIPPING WEIGHT (KG)</label>
                                    <select class="form-control form-control-sm" name="spchargeid" id="spchargeid">
                                        <option value="{{$billing->shippingcharge_id}}" selected></option>
                                        @foreach ($spcharge as $item)
                                        <option value="{{$item->id}}">{{$item->weight}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">

                            </div>
                            <div class="col-5">
                                <label for="spcharge">SHIPPING CHARGE ($)</label>
                            <input type="text" class="form-control" id="spcharge" name="spcharge" value="{{$billing->shippingcharge}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="prdprice">PRODUCT PRICE ($)</label>
                            <input type="text" class="form-control" id="prdprice" name="prdprice" value="{{$billing->productprice}}">
                        </div>

                        <div class="form-group">
                            <label for="dutax">DUTY TAX ($)</label>
                            <input type="text" class="form-control" id="dutax" name="dutax" value="{{$billing->dutytax}}">
                        </div>

                        <div class="form-group">
                            <label for="ntotal">NET TOTAL ($)</label>
                            <input type="text" class="form-control" id="ntotal" name="ntotal" value="{{$billing->nettotal}}">
                        </div>
                        <div class="form-group">
                            <label for="paystatus">PAYMENT STATUS</label>
                            <select class="form-control form-control-sm" name="paystatus" id="nettotal">
                                <option value="{{$billing->paymentstatus}}" selected>{{$billing->paymentstatus}}</option>
                                @if ($billing->paymentstatus  === "PAYED")
                                    <option value="NOT PAYED">NOT PAYED</option>
                                @endif
                                {{-- <option value="NOT PAYED">NOT PAYED</option> --}}
                                {{-- <option value="PAYED">PAYED</option> --}}
                            </select>
                        </div>

                        <button type="submit" class="btn btn-dark" id="submit_button">UPDATE</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function(){
      $("#spchargeid").change(function() {

        var selectedstatus = $(this).val();
        // console.log(selectedstatus);
        $.ajax({
          type: 'get',
          url: "{{ url('/admin/shippingchargelist') }}",
          data: {selectedstatus:selectedstatus},
          success:function(data){
            var st = $('#billingform');
            st.find('#spcharge').val(data.amount);
          }
      })

      });
    });
</script>

@endsection
