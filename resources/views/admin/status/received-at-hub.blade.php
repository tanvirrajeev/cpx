  <!-- Modal Asset Details-->
  <div class="modal fade" id="received-at-hub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <li class="current-time">
                        <span class="bubble"></span>
                        <span class="stacked-text">
                            Delivered
                            <span class="subdued"></span>
                        </span>
                    </li>
                    <li>
                        <span class="bubble"></span>
                        <span class="stacked-text">
                            Destination HUB
                            <span class="subdued"></span>
                        </span>
                    </li>
                    <li class="completed warning">
                        <span class="time">27/10/2020 02:48 AM</span>
                        <span class="bubble"></span>
                        <span class="stacked-text">
                            Receiving HUB
                            <span class="subdued" id="sts"></span>
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
    $('#received-at-hub').on('show.bs.modal', function (event) {
    var id = $(event.relatedTarget).data('id');
    // console.log(id);
        $.ajax({
            type: 'get',
            url: "{{ url('/admin/tracking') }}",
            data: {id:id},
            success:function(data){
                console.log(data);
                var st = $('#received-at-hub');
                // for (i in data) {
                //     console.log(data[0][i].ordid);
                //     st.find('#cpxid').text("CPX ID: " + data[0][i].ordid);
                //     st.find('#created-by').text("Created By: " + data[0][i].createdby);
                //     st.find('#created-at').text("Created At: " + $.format.date(data[0][i].created_at, "dd/MM/yyyy HH:mm a"));
                //     st.find('#sts').text(data[0][i].status);
                //     st.find('#awb').text("AWB: " + data[0][i].awb);

                // }
            }
        })
    });
</script>
