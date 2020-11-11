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
            <form action="updateform">
                <meta name="csrf-token" updateform="{{ csrf_token() }}" />
                <h4><p style="color:orange; font-weight:bold;">CPX ID: <span id="cpxid" style="color:red; font-weight:bold;"></span></p></h4>
                <select name="status" id="status"></select>
                <button type="button" class="btn btn-dark" id="updatests">UPDATE</button>
            </form>

            <div class="form-group">
                <textarea class="form-control" id="note" name="note" rows="3" style="display:none" placeholder="Must fillup if you select status as OTHERS..."></textarea>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="awbd" name="awbd" style="display:none" placeholder="Insert AWB...">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="rcvby" name="rcvby" style="display:none" placeholder="Receiver's Name">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-orange" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

  <script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('updateform');

    $('#chgstatusmodal').on('show.bs.modal', function (event) {
    var id = $(event.relatedTarget).data('id');
    // console.log(id);
    $("#chgstatusmodal").find('#status').empty();
    $("#chgstatusmodal").find('#cpxid').empty();

    getstatus();
    updatestatus();

    // Populate dropdown menu for status with selected option
    function getstatus(){

        //Hide all field at the begining.
        $("#chgstatusmodal").find('#awbd').hide();
        $("#chgstatusmodal").find('#note').hide();
        $("#chgstatusmodal").find('#rcvby').hide();

        $.ajax({
            type: 'get',
            url: "{{ url('/admin/getstatusmodal') }}",
            data: {id:id},
            success:function(data){
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
                var option ="<option value=\""+val.selected_status_id+"\" selected disabled>"+ val.selectes_status +"</option>";
                $("#chgstatusmodal").find('#status').append(option);
                });


                // Polulate select option for all statuses from the Status Table
                var status = data.status;
                $.each(status , function(index, val) {
                    if (sltstatusid != val.status_id){ //Populate the dropdown if the optioin is not equal to selected status ID
                        var option ="<option value=\""+val.status_id+"\">"+ val.status_name +"</option>";
                        $("#chgstatusmodal").find('#status').append(option);
                    }
                });

                // Setting up note/awb/rcvby value to the hidden field to retrieve from updatestatus()
                $.each(data.order , function(index, val) {
                    $("#chgstatusmodal").find('#awbd').val(val.awb);
                    $("#chgstatusmodal").find('#note').val(val.note);
                    $("#chgstatusmodal").find('#rcvby').val(val.rcvby);
                });
            }
        })
    }

    //Update status by AJAX POST
    function updatestatus(){
        // get the selected status from the dropdown
        var st = $('#chgstatusmodal');
        st.find('#status').change(function() {
            var selectedstatus = $(this).val();
            // console.log(selectedstatus);

            //Enable disable field based on dropdown select options. This is based on histories->flag table
            $.ajax({
                type: 'get',
                url: "{{ url('/admin/statuslist') }}",
                data: {selectedstatus:selectedstatus},
                success:function(data){
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
                    }else if(data == '9'){
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




                    //Status update by clicing Update button
                    $(document).on("click", "#updatests" , function() {
                        // get the selected status from the dropdown
                        var status = $('#chgstatusmodal').find('#status').val();
                        var awb = $('#chgstatusmodal').find('#awbd').val();
                        var note = $('#chgstatusmodal').find('#note').val();
                        var rcvby = $('#chgstatusmodal').find('#rcvby').val();

                        //Check if the field are not blank
                        if (data == '1' && $('#chgstatusmodal').find('#awbd').val()){
                            update();
                        }else if (data == '2' && $('#chgstatusmodal').find('#note').val()){
                            update();
                        }else if (data == '9' && $('#chgstatusmodal').find('#rcvby').val()){
                            update();
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Field Missing',
                                text: 'Please fill up all fields'
                                })
                        }

                    //Actual update function()
                    function update(){
                        //SweetAlert2 Toast for CPX Update confirmation
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        // Check if the field is blank. CPX ID getting from var id = $(event.relatedTarget).data('id');
                        if(id != ''){
                            // Sweetalert to check whether it is pressed by accidentally or not
                            Swal.fire({
                            title: 'Are you sure?',
                            text: "You want to update the Status?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, Update!'
                            }).then((result) => {
                                if (result.isConfirmed) {

                                    $.ajax({
                                    type: 'post',
                                    url: "{{ url('/admin/chgstatusmodal') }}",
                                    data: {_token: CSRF_TOKEN,id: id,status: status, awb: awb, note: note, rcvby: rcvby},
                                    success:function(data){
                                        // alert(data);
                                        // location.reload();
                                        // $('#getawb').find('#awbsrc1').val(awbchg);
                                        console.log("$data: "+ data);


                                        Toast.fire({
                                        type: 'success',
                                        icon: 'success',
                                        title: 'CPX UPDATED!'
                                        });
                                        location.reload();
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
                    }

                    });
                }
            })
        });
        }
    });
</script>
