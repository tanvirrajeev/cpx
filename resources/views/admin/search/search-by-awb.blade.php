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

                        <button type="button" class="btn btn-dark" id="searchawb">SEARCH</button>
                        <button type="button" class="btn btn-dark" id="chgsts">CHANGE STATUS</button>
                      </form>


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


<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).ready( function () {

        getawb();
        changestatus();

        // Fetch all CPX ID by AWB
        function getawb(){
            $(document).on("click", "#searchawb", function() {
            var awb = $('#getawb').find('#awbsrc1').val();
            // console.log("Getting AWB from Input Box..."+awb);
                $.ajax({
                    type: 'get',
                    url: "{{ url('/admin/awb') }}",
                    data: {awb:awb},
                    success:function(data){
                        // console.log("Reply from Controller $data..."+data);
                        // console.log("Data Length: " + data.length);
                        var length = data.length;
                        var s = $('#getawb').find('#datalength').val(length);
                        for (i in data){
                            // console.log(data[i]);

                            var cpxid = data[i].cpxid;
                            var ecom = data[i].ecomid;
                            var sts = data[i].status;
                            var awb = data[i].awb;
                            var id = i;
                        // console.log("cpx: "+ cpxid);
                            // console.log("ecom: "+ ecom);
                            // console.log("status: "+ sts);
                            // console.log("AWB: "+ awb);
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
            var awbchg = $('#getawb').find('#awbsrc1').val();
            console.log("Getting AWB from Input Box..."+awbchg);

            $.ajax({
                    type: 'post',
                    url: "{{ url('/admin/statusupdate') }}",
                    // data: {awb:awb},
                    data: {_token: CSRF_TOKEN,awbchg: awbchg},
                    success:function(data){
                        console.log("Reply from Controller $data..."+data);
                        alert(data);


                    }
                })

        });
        }





    });
</script>





@endsection


