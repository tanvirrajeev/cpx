  <!-- Modal Asset Details-->
  <link href="{{ asset('css/progress-wizard.min.css') }}" rel="stylesheet">
  <div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-navy">
          <h5 class="modal-title" id="exampleModalLabel">TRACKING</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">



            <style>
/* Demo for vertical bars */

.progress-indicator.stepped.stacked {
        width: 48%;
        display: inline-block;
    }
    .progress-indicator.stepped.stacked > li {
        height: 150px;
    }
    .progress-indicator.stepped.stacked > li .bubble {
        padding: 0.1em;
    }
    .progress-indicator.stepped.stacked > li:first-of-type .bubble {
        padding: 0.5em;
    }
    .progress-indicator.stepped.stacked > li:last-of-type .bubble {
        padding: 0em;
    }

    /* Nocenter */

    .progress-indicator.nocenter.stacked > li {
        min-height: 100px;
    }
    .progress-indicator.nocenter.stacked > li span {
        display: block;
    }

    /* Demo for Timeline vertical bars */

    #timeline-speaker-example {
        background-color: #2b4a6d;
        color: white;
        padding: 1em 2em;
        text-align: center;
        border-radius: 10px;
    }
    #timeline-speaker-example .progress-indicator {
        width: 100%;
    }
    #timeline-speaker-example .bubble {
        padding: 0;
    }
    #timeline-speaker-example .progress-indicator > li {
        color: white;
    }
    #timeline-speaker-example .time {
        position: relative;
        left: -80px;
        top: 30px;
        font-size: 130%;
        text-align: right;
        opacity: 0.6;
        font-weight: 100;
    }
    #timeline-speaker-example .current-time .time {
        font-size: 170%;
        opacity: 1;
    }
    #timeline-speaker-example .stacked-text {
        top: -37px;
        left: -50px;
    }
    #timeline-speaker-example .subdued {
        font-size: 10px;
        display: block;
    }
    #timeline-speaker-example > li:hover {
        color: #ff3d54;
    }
    #timeline-speaker-example > li:hover .bubble,
    #timeline-speaker-example > li:hover .bubble:before,
    #timeline-speaker-example > li:hover .bubble:after {
        background-color: #ff3d54;
    }
    #timeline-speaker-example .current-time .sub-info {
        font-size: 60%;
        line-height: 0.2em;
        text-transform: capitalize;
        color: #6988be;
    }
    @media handheld, screen and (max-width: 400px) {
        .container {
            margin: 0;
            width: 100%;
        }
        .progress-indicator.stacked {
            display: block;
            width: 100%;
        }
        .progress-indicator.stacked > li {
            height: 80px;
        }
    }
            </style>

            <div id="timeline-speaker-example">
                <h4>PACKAGE TRACKING</h4>
                <ul class="progress-indicator stacked dark">
                    <li class="current-time">
                        <span class="time">2:45 - 3:30</span>
                        <span class="bubble"></span>
                        <span class="stacked-text">
                            Some really cool title
                            <span class="subdued">By a special speaker</span>
                            <span class="sub-info">
                                <ul>
                                    <li>Intro to stuff</li>
                                    <li>Stuff</li>
                                    <li>Advanced Stuff</li>
                                </ul>
                            </span>
                        </span>
                    </li>
                    <li class="">
                        <span class="time">1:30 - 2:30</span>
                        <span class="bubble"></span>
                        <span class="stacked-text">
                            Some really cool title
                            <span class="subdued">By a special speaker</span>
                        </span>
                    </li>
                    <li>
                        <span class="time">12:45 - 1:30</span>
                        <span class="bubble"></span>
                        <span class="stacked-text">
                            Some really cool title
                            <span class="subdued">By a special speaker</span>
                        </span>
                    </li>
                    <li class="completed warning">
                        <span class="time">27/10/2020 02:48 AM</span>
                        <span class="bubble"></span>
                        <span class="stacked-text">
                            Some really cool title
                            <span class="subdued">By a special speaker</span>
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
