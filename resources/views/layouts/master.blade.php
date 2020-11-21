
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>CPX</title>

  {{-- Bootstrap  --}}
  <script  src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

  <script src='https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js'></script>
  <script src='/js/jquery-dateFormat.min.js'></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>



</head>
<body class="hold-transition sidebar-mini ">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" class="sidebar-toggle" data-toggle="push-menu" role="button" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-orange elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('/img/plbd_logo.jpg') }}" alt="Powerline" class="brand-image "
           style="opacity: .8">
      <span class="brand-text font-weight-light">Powerline CPX</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/img/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{{ Auth::user()->name }}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            </ul>


          {{-- For Admin Sidebar      --}}
          @if(Request::is('admin*'))
          <ul class="nav nav-sidebar flex-column">
            <li class="nav-item">
                <a href="/admin/dashboard" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : ''}}">
                    <i class="fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
        </ul>
          <ul class="nav nav-sidebar flex-column">
            <li class="nav-item">
                <a href="/admin/cpx" class="nav-link {{ Request::is('admin/cpx') ? 'active' : ''}}">
                  <i class="fas fa-shipping-fast nav-icon"></i>
                  <p>
                    CPX Order
                  </p>
                </a>
        </ul>
        <ul class="nav nav-sidebar flex-column">
            <li class="nav-item">
                <a href="/admin/order" class="nav-link {{ Request::is('admin/order') ? 'active' : ''}}">
                    <i class="fas fa-table nav-icon"></i>
                    <p>View Orders</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-sidebar flex-column">
            <li class="nav-item">
                <a href="/admin/billing" class="nav-link {{ Request::is('admin/billing') ? 'active' : ''}}">
                    <div style="font-size: 1.33rem;">
                        &nbsp;<i class="fas fa-dollar-sign "></i>
                        <p style="font-size: 1rem;">Billing</p>
                    </div>


                </a>
            </li>
        </ul>
        <ul class="nav nav-sidebar flex-column">
            <li class="nav-item">
                <a href="/admin/search" class="nav-link {{ Request::is('admin/search') ? 'active' : ''}}">
                    <div style="font-size: 1.33rem;">
                        &nbsp;<i class="fas fa-search"></i>
                        <p style="font-size: 1rem;">Update By AWB</p>
                    </div>
                </a>
            </li>
        </ul>
        <ul class="nav nav-sidebar flex-column">
            <li class="nav-item">
                <a href="/admin/searchorder" class="nav-link {{ Request::is('admin/searchorder') ? 'active' : ''}}">
                    <div style="font-size: 1.33rem;">
                        &nbsp;<i class="fas fa-search"></i>
                        <p style="font-size: 1rem;">Search Order</p>
                    </div>
                </a>
            </li>
        </ul>
          <ul class="nav nav-sidebar flex-column">
            <li class="nav-item">
                <a href="/admin/searchorderdate" class="nav-link {{ Request::is('admin/searchorderdate') ? 'active' : ''}}">
                    <div style="font-size: 1.33rem;">
                        &nbsp;<i class="fas fa-search"></i>
                        <p style="font-size: 1rem;">Search Order By Date</p>
                    </div>
                </a>
            </li>
          </ul>
        </ul>
        <ul class="nav nav-sidebar flex-column">
          <li class="nav-item">
              <a href="/admin/searchbillingdate" class="nav-link {{ Request::is('admin/searchbillingdate') ? 'active' : ''}}">
                  <div style="font-size: 1.33rem;">
                      &nbsp;<i class="fas fa-search"></i>
                      <p style="font-size: 1rem;">Search Billing By Date</p>
                  </div>
              </a>
          </li>
        </ul>
        <ul class="nav nav-sidebar flex-column" data-widget="treeview">
          <li class="treeview">
            <a href="#">SETTINGS</a>
            <ul class="treeview-menu">
              <li><a href="/admin/shippingcharge" class="{{ Request::is('admin/shippingcharge') ? 'active' : ''}}">SHIPPING CHARGE</a></li>
            </ul>
            <ul class="treeview-menu">
              <li><a href="#">USERS</a></li>
            </ul>
            <ul class="treeview-menu">
              <li><a href="#">BRANCH</a></li>
            </ul>
            <ul class="treeview-menu">
              <li><a href="#">STATUS</a></li>
            </ul>
          </li>
        </ul>
          @endif

        {{-- For Branch Sidebar      --}}
        @if(Request::is('branch*'))
        <ul class="nav nav-sidebar flex-column">
          <li class="nav-item">
              <a href="/branch/dashboard" class="nav-link {{ Request::is('branch/dashboard') ? 'active' : ''}}">
                  <i class="fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
              </a>
          </li>
        </ul>
          <ul class="nav nav-sidebar flex-column">
            <li class="nav-item">
                <a href="/branch/cpx" class="nav-link {{ Request::is('branch/cpx') ? 'active' : ''}}">
                  <i class="fas fa-shipping-fast nav-icon"></i>
                  <p>
                    CPX Order
                  </p>
                </a>
        </ul>
        <ul class="nav nav-sidebar flex-column">
            <li class="nav-item">
                <a href="/branch/order" class="nav-link {{ Request::is('branch/order') ? 'active' : ''}}">
                    <i class="fas fa-table nav-icon"></i>
                    <p>View Orders</p>
                </a>
            </li>
        </ul>
          @endif


          {{-- For Customer Sidebar      --}}
        @if(Request::is('customer*'))
        <ul class="nav nav-sidebar flex-column">
            <li class="nav-item">
                <a href="/customer/cpx" class="nav-link {{ Request::is('customer/cpx') ? 'active' : ''}}">
                  {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
                  <i class="fas fa-shipping-fast nav-icon"></i>
                  <p>
                    CPX Order
                  </p>
                </a>
        </ul>
        <ul class="nav nav-sidebar flex-column">
            <li class="nav-item">
                <a href="/customer/order" class="nav-link {{ Request::is('customer/order') ? 'active' : ''}}">
                    {{-- <i class="far fa-circle nav-icon"></i> --}}
                    {{-- <i class="fas fa-people-carry nav-icon"></i> --}}
                    <i class="fas fa-table nav-icon"></i>
                    <p>View Orders</p>
                </a>
            </li>
        </ul>
        @endif

        <ul class="nav nav-sidebar flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                    <i class="fas fa-sign-out-alt"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </li>
        </ul>


      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <br>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

            @yield('content')


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Powered by: Intrinsic Ltd.
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020-2021 <a href="www.powerlinebd.net">Powerline Air Express Ltd.</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

@include('sweetalert::alert');

{{-- <script src='/js/app.js' defer></script> --}}

{{-- Datetime picker --}}
<link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">


{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

{{-- Datepicker  --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>
<script src="/js/sweetalert2.js"></script>

<script >
$('#datetimepicker2').datepicker({
    format: 'dd/mm/yyyy',
    weekStart: 0,
    todayBtn: "linked",
    language: "en",
    orientation: "bottom auto",
    keyboardNavigation: true,
    autoclose: true
});
</script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

{{-- Toggle Sidebar  --}}
<script>
    $(document).on('click', '[data-toggle="push-menu"]', function () {
    if (!$('body').hasClass("sidebar-collapse") && $('body').hasClass("sidebar-open")) {
        $('body').removeClass("sidebar-open");
        $('body').addClass("sidebar-collapse");
        $('body').addClass("sidebar-mini");
    //console.log('menu kapa');
    } else if($('body').hasClass("sidebar-collapse")) {
        $('body').removeClass("sidebar-collapse");
        $('body').addClass("sidebar-open");
    //console.log('menu ac');
    } else {
        $('body').addClass("sidebar-collapse");
        $('body').addClass("sidebar-open");
    }
});
</script>

{{-- Treeview collapse  --}}
<script>
//  $(document).ready(function() {

//     });


 /** add active class and stay opened when selected */
 var url = window.location;

// for sidebar menu entirely but not cover treeview
$('ul.sidebar-menu a').filter(function() {
   return this.href == url;
}).parent().addClass('active');

// for treeview
$('ul.treeview-menu a').filter(function() {
   return this.href == url;
}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
</script>
</body>
</html>
