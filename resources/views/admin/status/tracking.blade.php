  <!-- Modal Asset Details-->
  <div class="modal fade" id="tracking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-navy">
          <h5 class="modal-title" id="exampleModalLabel">TRACKING</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="tracking-body">
            <div id="timeline-speaker-example">
                <h4>PACKAGE TRACKING</h4><br>
                <ul class="progress-indicator stacked dark" id="tracking-ul">
                    {{-- <li class="completed warning">
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
                    </li> --}}


                    {{-- <span style="font-size: 3em; color: Orange;">
                        <i class="fas fa-truck-moving"></i> &nbsp;
                        <span style="font-size: 0.4em; font-family: 'Lato'; color: White;" class="stacked-text">
                            Order Created
                            <span class="subdued" id="cpxid"></span>
                            <span class="subdued" id="created-by"></span>
                            <span class="subdued" id="created-at"></span>
                        </span>
                      </span> --}}
                </ul>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-orange" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script src='/js/jquery-dateFormat.min.js'></script>

<script>
    $('#tracking').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id'); //get status id from controller editcolumn
        // $('#tracking-body').find('#span').replaceAll("")
        // $("").replaceAll("span");

        $.ajax({
            type: 'get',
            url: "{{ url('/admin/tracking') }}",
            data: {id:id},
            success:function(data){
                // console.log(data);
                var st = $('#tracking-body');
                st.find('#tracking-ul').empty(); //Refresh view everytime to display a new CPX tracking

                for (i in data) {
                    console.log(data[i]);
                    if (data[i].status_id  == 1){
                        // st.find('#sts-rcvdsthub').text(data[i].status);
                        // st.find('#created-at-rcvdsthub').text($.format.date(data[i].created_at, "dd/MM/yyyy HH:mm a"));
                        var time = $.format.date(data[i].created_at, "dd/MM/yyyy HH:mm a");

                        st.find('#tracking-ul').append("<li class=\"completed warning\">" +
                                "<span class=\"time\" id=\"created-at-rcvdsthub\">"+time+"</span>" +
                                "<span class=\"bubble\"></span>" +
                                "<span class=\"stacked-text\">Destination HUB" +
                                "<span class=\"subdued\" id=\"sts-rcvdsthub\">"+data[i].status+"</span>" +
                                "</span>"+
                                "</li>");



                        }else if (data[i].status_id  == 2){
                            // st.find('#sts-rcvhub').text(data[i].status);
                            // st.find('#awb').text("AWB: " + data[i].awb);
                            // st.find('#created-at-rcvhub').text($.format.date(data[i].created_at, "dd/MM/yyyy HH:mm a"));

                            var time = $.format.date(data[i].created_at, "dd/MM/yyyy HH:mm a");

                            st.find('#tracking-ul').append("<li class=\"completed warning\">" +
                                "<span class=\"time\" id=\"created-at-rcvhub\">"+time+"</span>" +
                                "<span class=\"bubble\"></span>" +
                                "<span class=\"stacked-text\">Receiving HUB" +
                                "<span class=\"subdued\" id=\"sts-rcvhub\">"+data[i].status+"</span>" +
                                "<span class=\"subdued\" id=\"awb\">AWB: "+data[i].awb+"</span>" +
                                "</span>"+
                                "</li>");


                        }else if (data[i].status_id  == 3){
                            var time = $.format.date(data[i].created_at, "dd/MM/yyyy HH:mm a");
                            // st.find('#cpxid').text("CPX ID: " + data[i].order_id);
                            // st.find('#created-by').text("Created By: " + data[i].name);
                            // st.find('#created-at').text("Created At: " + $.format.date(data[i].created_at, "dd/MM/yyyy HH:mm a"));

                            st.find('#tracking-ul').append("<span style=\"font-size: 3em; color: Orange;\">" +
                                "<i class=\"fas fa-truck-moving\"></i> &nbsp;" +
                                "<span style=\"font-size: 0.4em; font-family: 'Lato'; color: White;\" class=\"stacked-text\">Order Created" +
                                "<span class=\"subdued\" id=\"cpxid\">CPX ID: " +data[i].order_id+"</span>" +
                                "<span class=\"subdued\" id=\"created-by\">Created By: " + data[i].name +"</span>" +
                                "<span class=\"subdued\" id=\"created-at\">Created At: "+ time +"</span>" +
                                "</span>" +
                                "</span>");



                        }else if (data[i].status_id  == 7){
                            // st.find('#created-at-dlvrd').text($.format.date(data[i].created_at, "dd/MM/yyyy HH:mm a"));
                            // st.find('#reveived_by').text("Received By: " + data[i].reveived_by);
                            var time = $.format.date(data[i].created_at, "dd/MM/yyyy HH:mm a");

                            st.find('#tracking-ul').append("<li class=\"completed warning\">" +
                                "<span class=\"time\" id=\"created-at-dlvrd\">"+time+"</span>" +
                                "<span class=\"bubble\"></span>" +
                                "<span class=\"stacked-text\"> Delivered &nbsp; &nbsp; <span style=\"color: rgb(78, 184, 78);\"><i class=\"fas fa-check-circle\"></i></span>" +
                                "<span class=\"subdued\" id=\"reveived_by\">Received By: "+data[i].reveived_by+"</span>" +
                                "</span>"+
                                "</li>");



                        };

                    // else{
                    //     $('#tracking-body').empty();
                    // };

                }
            }
        })
    });
</script>
