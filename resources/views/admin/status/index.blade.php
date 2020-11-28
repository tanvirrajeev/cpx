@extends('layouts.master')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-orange"><h3>{{ __('USERS') }}</h3>
                    <a href="status/create" class="btn btn-outline-warning btn-sm float-right"><i class="fas fa-plus fa-lg">&nbsp;</i>CREATE STATUS</a>
                </div>
                <div class="card-body">
                    <table class="table border" id="statuslist">
                        <thead>
                                <th>NAME</th>
                                {{-- <th>CREATED BY</th> --}}
                                <th>ACTION</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>NAME</th>
                                {{-- <th>CREATED BY</th> --}}
                                <th>ACTION</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- DataTalbe for Admin Order page --}}
<script>
    $(document).ready( function () {
    $('#statuslist').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        // order: [0, 'desc'],
        ajax: '{!! route('admin.status.stlist') !!}',
        // columnDefs: [{ "orderable": false, "targets": '_all' }],
        columns: [
            // { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            // { data: 'consigneename', name: 'consigneename' },
            // { data: 'user_id', name: 'user_id' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
@endsection

