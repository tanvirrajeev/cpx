  <!-- Modal Asset Details-->
  <div class="modal fade" id="chgstatusmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header bg-navy">
          <h5 class="modal-title" id="exampleModalLabel">STATUS</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h4><p style="color:orange; font-weight:bold;">CPX ID: <span id="cpxid" style="color:red; font-weight:bold;"></span></p></h4>
            <select name="status" id="status"></select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-orange" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('#chgstatusmodal').on('show.bs.modal', function (event) {
    var id = $(event.relatedTarget).data('id');
    // console.log(id);
    $("#chgstatusmodal").find('#status').empty();
    $("#chgstatusmodal").find('#cpxid').empty();

    getstatus();


    // Populate dropdown menu for status with selected option
    function getstatus(){
        $.ajax({
            type: 'get',
            url: "{{ url('/admin/chgstatusmodal') }}",
            data: {id:id},
            success:function(data){
                // console.log(data.status);
                // console.log(data.order);

                // var sltstatus = '';
                var sltstatusid = '';

                // Setting up selected status
                var sltstatus = data.order;
                $.each(sltstatus , function(index, val) {

                // Display Order ID on Modal Header
                var cpx = val.cpxid;
                $("#chgstatusmodal").find('#cpxid').append(cpx);

                // Setting up selected option (for the order) for the dropdown
                sltstatusid = val.selected_status_id;
                var option ="<option value=\""+val.selected_status_id+"\" selected>"+ val.selectes_status +"</option>";
                $("#chgstatusmodal").find('#status').append(option);
                });


                // Polulate up select option for all statuses from the Status Table
                var status = data.status;
                $.each(status , function(index, val) {
                    if (sltstatusid != val.status_id){ //Populate the dropdown if the optioin is not equal to selected status ID
                        var option ="<option value=\""+val.status_id+"\">"+ val.status_name +"</option>";
                        $("#chgstatusmodal").find('#status').append(option);
                    }
                });
            }
        })
    }


    });
</script>
