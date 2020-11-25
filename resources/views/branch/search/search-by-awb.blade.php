@extends('layouts.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header bg-orange"><h3>{{ __('Update By AWB') }}</h3></div>
                <div class="card-body">
                    <form id="getawb">
                        {{-- <form action="/admin/search/{{ $order->id}}" method="POST" id="orderform"> --}}
                        {{-- <form action="{{ route('order.store') }}" method="POST"> --}}
                        {{-- @csrf --}}
                        {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="awbsrc1">AWB</label>
                                    <input type="text" class="form-control" id="awbsrc1" name="awbsrc1">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="datalength" name="datalength">

                        <button type="button" class="btn bg-purple" id="searchawb">SEARCH</button>
                        <button type="button" class="btn bg-maroon" id="chgsts">ARRIVED AT DHAKA</button>
                      </form>
                      <br>

                      <p style="color:blue;">***DO NOT FORGET TO CHANGE STATUS <span style="color:red; font-weight:bold;">"PACKAGE ON-HOLD"</span> BEFORE CHANGE THE STATUS BY AWB</p>

                      <table id="showcpxbyawbtbl" class="table table-striped table-bordered hover" style="width:100%">
                        <thead class="bg-warning">
                            <tr>
                                <th>SHIPPING CODE</th>
                                <th>ECOM ORDER</th>
                                <th>STATUS</th>
                                <th>AWB</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- For Sweetalert2 calling from JS  --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> --}}


<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).ready( function () {

        getawb();
        changestatus();

        // Fetch all CPX ID by AWB
        function getawb(){
            $(document).on("click", "#searchawb", function() {
            var awb = $('#getawb').find('#awbsrc1').val();
            $("#showcpxbyawbtbl tbody").empty();
            // console.log("Getting AWB from Input Box..."+awb);
                $.ajax({
                    type: 'get',
                    url: "{{ url('/branch/awb') }}",
                    data: {awb:awb},
                    success:function(data){
                        var length = data.length;
                        var s = $('#getawb').find('#datalength').val(length);
                        for (i in data){
                            var cpxid = data[i].cpxid;
                            var ecom = data[i].ecomid;
                            var sts = data[i].status;
                            var awb = data[i].awb;
                            var id = i;
                        var tr_str = "<tr>"+
                            "<td align='center'><input type='text' value='" + cpxid + "' id='cpxid"+id+"' disabled ></td>" +
                            "<td align='center'><input type='text' value='" + ecom + "' id='ecomid"+id+"' disabled></td>" +
                            "<td align='center'><input type='email' value='" + sts + "' id='status"+id+"' disabled></td>" +
                            "<td align='center'><input type='email' value='" + awb + "' id='awb"+id+"' disabled></td>" +
                            "</tr>";
                            $("#showcpxbyawbtbl tbody").append(tr_str);
                        }
                    }
                })
        });
        }


        // Change all CPX status by AWB
        function changestatus(){
            // $(document).on("click", "#chgsts", function() {
            $(document).on("click", "#chgsts" , function() {
            // get the awb whihc needs to be changed
            var awbchg = $('#getawb').find('#awbsrc1').val();

            //SweetAlert2 Toast for CPX Update confirmation
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });

            // Check if ABW field is blank
            if($('#getawb').find('#awbsrc1').val()){
                Swal.fire({
                title: 'Are you sure?',
                text: "You want to update all CPX Status!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                        type: 'post',
                        url: "{{ url('/branch/statusupdate') }}",
                        // data: {awb:awb},
                        data: {_token: CSRF_TOKEN,awbchg: awbchg},
                        success:function(data){
                            // alert(data);
                            // location.reload();
                            // $('#getawb').find('#awbsrc1').val(awbchg);
                            $("#showcpxbyawbtbl tbody").empty();

                            // Populating the list after changing the status
                            var awb = $('#getawb').find('#awbsrc1').val();
                                $.ajax({
                                    type: 'get',
                                    url: "{{ url('/branch/awb') }}",
                                    data: {awb:awb},
                                    success:function(data){
                                        var length = data.length;
                                        var s = $('#getawb').find('#datalength').val(length);
                                        for (i in data){
                                            var cpxid = data[i].cpxid;
                                            var ecom = data[i].ecomid;
                                            var sts = data[i].status;
                                            var awb = data[i].awb;
                                            var id = i;
                                        var tr_str = "<tr>"+
                                            "<td align='center'><input type='text' value='" + cpxid + "' id='cpxid"+id+"' disabled ></td>" +
                                            "<td align='center'><input type='text' value='" + ecom + "' id='ecomid"+id+"' disabled></td>" +
                                            "<td align='center'><input type='text' value='" + sts + "' id='status"+id+"' disabled></td>" +
                                            "<td align='center'><input type='text' value='" + awb + "' id='awb"+id+"' disabled></td>" +
                                            "</tr>";
                                            $("#showcpxbyawbtbl tbody").append(tr_str);
                                        }
                                    }
                                })

                            Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: 'CPX UPDATED!'
                            });
                            }
                        })
                    }
                })
            }else{
                Swal.fire({
                title: 'Error!',
                text: "AWB field can not be left blank",
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
                })
            }

        });
        }
    });
</script>

@endsection


