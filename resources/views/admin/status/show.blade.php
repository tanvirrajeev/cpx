@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">
            <div class="card">

                {{-- Validation Error Message --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-header bg-navy"><h3>{{ __('VIEW STATUS') }}</h3>
                    <a href="{{route('admin.status.index')}}" class="btn btn-outline-warning btn-sm float-right"><i class="fas fa-backward"></i>&nbsp;</i>BACK</a>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.status.store') }}" method="POST">
                        {{-- <form action="{{ route('order.store') }}" method="POST"> --}}
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">STATUS</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="name" name="name" style="text-transform: uppercase" value="{{ $st->name }}" disabled autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="flag">FIELD</label><label class="text-danger">*</label>
                                    <select class="form-control form-control-sm" name="flag" id="flag" disabled>
                                        @if ($st->flag == 1)
                                            <option value="{{ $st->flag }}" selected disabled>AWB</option>
                                            @elseif($st->flag == 2)
                                                <option value="{{ $st->flag }}" selected disabled>NOTE</option>
                                            @elseif($status->flag == 3)
                                                <option value="{{ $st->flag }}" selected disabled>N/A</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">CREATED BY</label>
                                    <input type="text" class="form-control" id="user" name="user"  value="{{ $st->user }}" disabled autofocus>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">CREATED AT</label>
                                    <input type="text" class="form-control" id="user" name="user"  value="{{ $st->date }}" disabled autofocus>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('admin.status.index')}}" class="btn btn-dark">BACK</a>
                        {{-- <button type="submit" class="btn btn-dark" id="submit_button" >UPDATE</button> --}}
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
