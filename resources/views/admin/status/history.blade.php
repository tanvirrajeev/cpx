  <!-- Modal Asset Details-->
  <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header bg-navy">
          <h5 class="modal-title" id="exampleModalLabel">TRACK ORDER HISTORY</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="history-body">
            <table id="history-table" class="table table-striped table-bordered hover" style="width:100%">
                <thead class="bg-warning">
                    <tr>
                        <th>DATE</th>
                        <th>STATUS</th>
                        <th>UPDATED BY</th>
                        <th>BRANCH</th>
                        <th>NOTE</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-orange" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



<script>
    $('#history').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id'); //get status id from controller editcolumn
        // event.preventDefault();
        console.log(id);

        $.ajax({
            type: 'get',
            url: "{{ url('/admin/gethistory') }}",
            data: {id:id},
            success:function(data){
                // console.log(data);


                for (i in data) {
                    console.log(data[i]);
                    var tr_str = "<tr>"+
                        "<td align='center'><input type='text' value='" + data[i].date + "' id='date"+data[i].hisid+"' disabled ></td>" +
                        "<td align='center'><input type='text' value='" + data[i].date + "' id='date"+data[i].hisid+"' disabled ></td>" +
                        "<td align='center'><input type='text' value='" + data[i].status + "' id='status"+data[i].hisid+"' disabled></td>" +
                        "<td align='center'><input type='text' value='" + data[i].updateby + "' id='updateby"+data[i].hisid+"' disabled></td>" +
                        "<td align='center'><input type='text' value='" + data[i].branch + "' id='branch"+data[i].hisid+"' disabled></td>" +
                        // "<td align='center'><input type='text' value='" + data[i].note + "' id='note"+data[i].hisid+"' disabled></td>" +
                        "<td align='center'><textarea class=\"form-control\" rows=\"4\" id='id"+data[i].hisid+"' disabled>"+data[i].note+"</textarea></td>" +
                        "</tr>";
                        $("#history-table tbody").append(tr_str);


                }
            }
        })
    });
</script>
