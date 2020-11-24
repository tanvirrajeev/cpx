  <!-- Modal Asset Details-->
  <div class="modal fade" id="cpx" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-navy">
          <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="cpx-body">
            <div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div>
                        <h4 style="color:red;"><label>ORDER ID: <span id="cpxid"></span></label></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label>E-COMMERCE NAME: </label> &nbsp;<input type="text" class="form-control" id="ecomnames" disabled>
                    </div>
                    <div class="col-1">

                    </div>
                    <div class="col-5">
                        <label>E-COMMERCE ORDER ID: </label> &nbsp;<input type="text" class="form-control" id="ecomordida" disabled>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-6">
                        <label>SHIPPING PRIORITY: </label> &nbsp;<input type="text" class="form-control" id="ecomsppngpriorityq" disabled>
                    </div>
                    <div class="col-1">

                    </div>
                    <div class="col-5">
                        <label>PRODUCT ORDERED DATE: </label> &nbsp;<input type="text" class="form-control" id="ecomorddtt" disabled>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-4">
                        <label>CONSIGNEE NAME </label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" id="consigneenamer" disabled>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-4">
                        <label>PRODUCT DESCRIPTION: </label>
                    </div>
                    <div class="col-7">
                        <textarea class="form-control" rows="4" id="ecomproddescd" disabled></textarea>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-4">
                        <label>CONSIGNEE ADDRESS: </label>
                    </div>
                    <div class="col-7">
                        <textarea class="form-control" rows="4" id="consigneeaddrsf" disabled></textarea>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-4">
                        <label>NOTE: </label>
                    </div>
                    <div class="col-7">
                        <textarea class="form-control" rows="4" id="note" disabled></textarea>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-4">
                        <label>PRODUCT TRACKING LINK </label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" id="ecomprdtraclnke" disabled>
                    </div>
                </div> <br>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-orange" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <script>
    $('#cpx').on('show.bs.modal', function (event) {
        // event.preventDefault();
        var id = $(event.relatedTarget).data('id'); //get CPX id from controller editcolumn
        var st = $('#cpx-body');
        st.find('#cpxid').empty();

        $.ajax({
            type: 'get',
            url: "{{ url('/branch/getorder') }}",
            data: {id:id},
            success:function(data){

                for(i in data){
                    console.log(data[i].id);
                    st.find('#cpxid').append(data[i].id);
                    st.find('#ecomnames').val(data[i].ecomname);
                    st.find('#ecomordida').val(data[i].ecomordid);
                    st.find('#ecomsppngpriorityq').val(data[i].ecomsppngpriority);
                    st.find('#ecomorddtt').val(data[i].ecomorddt);
                    st.find('#consigneenamer').val(data[i].consigneename);
                    st.find('#ecomproddescd').val(data[i].ecomproddesc);
                    st.find('#consigneeaddrsf').val(data[i].consigneeaddrs);
                    st.find('#note').val(data[i].note);
                    st.find('#ecomprdtraclnke').val(data[i].ecomprdtraclnk);
                }
            }
        })
    });
</script>
