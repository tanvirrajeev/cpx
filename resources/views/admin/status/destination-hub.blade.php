  <!-- Modal Asset Details-->
  <div class="modal fade" id="delivered" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-navy">
          <h5 class="modal-title" id="exampleModalLabel">TRACKING</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="timeline-speaker-example">
                <h4>PACKAGE TRACKING</h4><br>
                <ul class="progress-indicator stacked dark">
                    <li class="completed warning">
                        <span class="time" id="created-at-dlvrd"></span>
                        <span class="bubble"></span>
                        <span class="stacked-text">
                            Delivered &nbsp; &nbsp; <span style="color: rgb(78, 184, 78);"><i class="fas fa-check-circle"></i></span>
                            <span class="subdued" id="reveived_by"></span>
                        </span>
                    </li>
                    <li class="completed warning">
                        <span class="time" id="created-at-rcvdsthub"></span>
                        <span class="bubble"></span>
                        <span class="stacked-text">
                            Destination HUB
                            <span class="subdued" id="sts-rcvdsthub"></span>
                        </span>
                    </li>
                    <li class="completed warning">
                        <span class="time" id="created-at-rcvhub"></span>
                        <span class="bubble"></span>
                        <span class="stacked-text">
                            Receiving HUB
                            <span class="subdued" id="sts-rcvhub"></span>
                            <span class="subdued" id="awb"></span>
                        </span>
                    </li>
                    <span style="font-size: 3em; color: Orange;">
                        <i class="fas fa-truck-moving"></i> &nbsp;
                        <span style="font-size: 0.4em; font-family: 'Lato'; color: White;" class="stacked-text">
                            Order Created
                            <span class="subdued" id="cpxid"></span>
                            <span class="subdued" id="created-by"></span>
                            <span class="subdued" id="created-at"></span>
                        </span>
                      </span>
                </ul>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-orange" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
    $('#delivered').on('show.bs.modal', function (event) {
    var id = $(event.relatedTarget).data('id');
        $.ajax({
            type: 'get',
            url: "{{ url('/admin/tracking') }}",
            data: {id:id},
            success:function(data){
                // console.log(data);
                var st = $('#delivered');

                for (i in data) {
                    // console.log(data[i]);
                    if (data[i].status_id  == 1){
                        console.log("ARRIVED AT DHAKA: ");
                        console.log(data[i]);
                        st.find('#sts-rcvdsthub').text(data[i].status);
                        st.find('#created-at-rcvdsthub').text($.format.date(data[i].created_at, "dd/MM/yyyy HH:mm a"));

                        }else if (data[i].status_id  == 2){
                            console.log("ARRIVED AT DELHI: ");
                            console.log(data[i]);
                            st.find('#sts-rcvhub').text(data[i].status);
                            st.find('#awb').text("AWB: " + data[i].awb);
                            st.find('#created-at-rcvhub').text($.format.date(data[i].created_at, "dd/MM/yyyy HH:mm a"));
                        }else if (data[i].status_id  == 3){
                            console.log("NOT ARRIVED: ");
                            console.log(data[i]);
                            st.find('#cpxid').text("CPX ID: " + data[i].order_id);
                            st.find('#created-by').text("Created By: " + data[i].name);
                            st.find('#created-at').text("Created At: " + $.format.date(data[i].created_at, "dd/MM/yyyy HH:mm a"));

                        }else if (data[i].status_id  == 7){
                            console.log("DELIVERED: ");
                            console.log(data[i]);
                            // st.find('#sts-dlvrd').text(data[i].status);
                            st.find('#created-at-dlvrd').text($.format.date(data[i].created_at, "dd/MM/yyyy HH:mm a"));
                            st.find('#reveived_by').text("Received By: " + data[i].reveived_by);
                        };

                    // else{
                    //     console.log("OTHERS: ");
                    //     console.log(data[i]);
                    // };

                }
            }
        })
    });
</script>
