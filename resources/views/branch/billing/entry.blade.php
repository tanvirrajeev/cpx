@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-dark"><h3>{{ __('Billing') }}</h3></div>

                <div class="card-body bg-orange">

                    <form action="/branch/billing/{{$billing->id}}" method="POST" id="billingform">
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
                                        <option selected disabled>{{$billing->shippingcharge_id}}</option>
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
                            <input type="text" class="calc form-control" id="spcharge" name="spcharge" value="{{$billing->shippingcharge}}" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="prdprice">PRODUCT PRICE ($)</label>
                            <input type="text" class="calc form-control" id="prdprice" name="prdprice" value="{{$billing->productprice}}" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="dutax">DUTY TAX ($)</label>
                            <input type="text" class="calc form-control" id="dutax" name="dutax" value="{{$billing->dutytax}}" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="ntotal">NET TOTAL ($)</label>
                            <input type="text" class="form-control" id="ntotal" name="ntotal" value="{{$billing->dutytax}}" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="paystatus">PAYMENT STATUS</label>
                            <select class="form-control form-control-sm" name="paystatus" id="nettotal">
                                <option value="NOT PAYED" selected>NOT PAYED</option>
                                <option value="PAYED">PAYED</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-dark" id="submit_button">ENTRY</button>
                      </form>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Shipping Charge Autocomplete based on weight --}}
<script>
    jQuery(document).ready(function(){
      $("#spchargeid").change(function() {
        var selectedstatus = $(this).val();
        console.log(selectedstatus);
        $.ajax({
          type: 'get',
          url: "{{ url('/branch/spchargelist') }}",
          data: {selectedstatus:selectedstatus},
          success:function(data){
            //   console.log(data.amount);
            var st = $('#billingform');
            st.find('#spcharge').val(data.amount);
            $('#hiddenfld').find('#hidspcharge').val(data.amount);
          }
      })
      });
    });
</script>

{{-- NetTotal auto calculation --}}
<script>
    $(document).ready(function(){
        // $( ".calc" ).change(function() {
        $(".calc").on("change input mousedown", function() {
            var ntotal = 0;
            $('.calc').each(function(){
                if($(this).val() != ''){
                    ntotal += parseFloat($(this).val());
                }
            });

            $('#billingform').find('#ntotal').val(ntotal);
        });
});
</script>

@endsection
