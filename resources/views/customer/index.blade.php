@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-dark"><h3>{{ __('Order Now') }}</h3></div>

                <div class="card-body bg-orange">

                    <form action="{{ route('customer.order.store') }}" method="POST">
                        {{-- <form action="{{ route('order.store') }}" method="POST"> --}}
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ecomordida">PRODUCT ORDER NO</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="ecomordida" name="ecomordida" placeholder="Order id given by E-Commerce" value="{{ old('ecomordida') }}" required autocomplete="ecomordida" autofocus>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ecomnames">PRODUCT ORDERED FROM</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="ecomnames" name="ecomnames" placeholder="Amazone, Flipkart etc." value="{{ old('ecomnames') }}" required autocomplete="ecomnames">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ecomproddescd">PRODUCT DESCRIPTION</label><label class="text-danger">*</label>
                            <textarea class="form-control" id="ecomproddescd" name="ecomproddescd" placeholder="Describe your product" value="{{ old('ecomproddescd') }}" required autocomplete="ecomproddescd"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="ecomsppngpriorityq">PRODUCT SHIPPING PRIORITY</label>
                                    <select class="form-control form-control-sm" name="ecomsppngpriorityq" id="ecomsppngpriorityq">
                                        <option value="NORMAL" selected>NORMAL</option>
                                        <option value="HIGH">HIGH</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">

                            </div>
                            <div class="col-5">
                                <label for="ecomorddtt">DATE OF THE PRODUCT ORDERED</label><label class="text-danger">*</label>
                              <i class="fa fa-calendar-alt"></i>
                              {{-- <input type="text" class="datetimepicker" name="ecomorddtt" id="ecomorddtt" autocomplete="off" required> --}}
                              {{-- <input type="text" name="ecomorddtt" id="ecomorddtt" autocomplete="off" required> --}}
                              {{-- <i class="fa fa-calendar-alt"></i> --}}
                              <div class="input-group date" id="datetimepicker2">
                                <input type="text" class="form-control" name="ecomorddtt" id="ecomorddtt" autocomplete="off" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                              </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="consigneenamer">CONSIGNEE NAME</label><label class="text-danger">*</label>
                            <input type="text" class="form-control" id="consigneenamer" name="consigneenamer" placeholder="Receiver's Name" value="{{ old('consigneenamer') }}" required autocomplete="consigneenamer">
                        </div>

                        <div class="form-group">
                            <label for="consigneeaddrsf">CONSIGNEE ADDRESS</label><label class="text-danger">*</label>
                            <textarea class="form-control" id="consigneeaddrsf" name="consigneeaddrsf" placeholder="CPX Destination" value="{{ old('consigneeaddrsf') }}" required autocomplete="consigneeaddrsf"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="ecomprdtraclnke">PRODUCT TRACKING LINK (IF AVAILABLE)</label>
                            <input type="text" class="form-control" id="ecomprdtraclnke" name="ecomprdtraclnke" placeholder="E-Commerce Tracking Link if Available" value="{{ old('consigneenamer') }}">
                        </div>

                        <div>
                            <p><input type="checkbox" id="terms_and_conditions" value="1" onclick="terms_changed(this)" />&nbsp; I AGREE TO PAY DUTY/TAX AND OTHER SURCHARGE TO BE PAID TO THE GOVERNMENT OF INDIA AND BANGLADESH TO SHIP MY PRODUCT <br> <br></p>
                        </div>

                        <button type="submit" class="btn btn-dark" id="submit_button" disabled>SUBMIT</button>
                      </form>


                </div>
            </div>
        </div>
    </div>
</div>

{{-- Terms & Condition check box --}}
<script>
    function terms_changed(termsCheckBox){
    //If the checkbox has been checked
    if(termsCheckBox.checked){
        //Set the disabled property to FALSE and enable the button.
        document.getElementById("submit_button").disabled = false;
    } else{
        //Otherwise, disable the submit button.
        document.getElementById("submit_button").disabled = true;
    }
}
</script>

@endsection
