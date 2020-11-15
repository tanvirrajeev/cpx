@extends('layouts.master')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/b-1.6.5/b-flash-1.6.5/cr-1.5.2/r-2.2.6/rr-1.2.7/sc-2.0.3/sb-1.0.0/sp-1.2.1/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/b-1.6.5/b-flash-1.6.5/cr-1.5.2/r-2.2.6/rr-1.2.7/sc-2.0.3/sb-1.0.0/sp-1.2.1/datatables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-orange"><h3>{{ __('Update By AWB') }}</h3></div>
                <div class="card-body">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">SHIPPING CODE</th>
                                <th class="text-center">ECOM ORDER</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center">AWB</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ord as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->ecomordid}}</td>
                                <td>{{$item->status_id}}</td>
                                <td>{{$item->awb}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
 </script>
@endsection
