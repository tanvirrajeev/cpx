  <!-- Modal Tracking Details-->
  <link href="{{ asset('css/progress-wizard.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/vertical-bar.css') }}" rel="stylesheet">
  <div class="modal fade" id="order-created" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <li class="">
                        <span class="bubble"></span>
                        <span class="stacked-text">
                            Out for Delivery
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
                    <li >
                        <span class="bubble"></span>
                        <span class="stacked-text">
                            Receiving HUB
                            <span class="subdued"></span>
                        </span>
                    </li>
                    <span style="font-size: 3em; color: Orange;">
                        <i class="fas fa-truck-moving"></i> &nbsp;
                        <span style="font-size: 0.4em; font-family: 'Lato'; color: White;" class="stacked-text">
                            Order Created
                            <span class="subdued">By: tanvir@abc.com</span>
                            <span class="subdued">created at: 29/10/2020 12:34 PM</span>
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
