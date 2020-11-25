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

                <div class="card-header bg-maroon"><h3>{{ __('VIEW USER') }}</h3>
                    <a href="/admin/employee/" class="btn btn-outline-warning btn-sm float-right"><i class="fas fa-backward"></i>&nbsp;</i>BACK</a>
                </div>

                <div class="card-body">

                    <form action="/admin/employee/{{ $sltuser->id }}" method="GET">
                        {{-- <form action="{{ route('order.store') }}" method="POST"> --}}
                        {{-- @csrf
                        @method('PUT') --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">NAME</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $sltuser->name}}" disabled autofocus>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">EMPLOYEE EMAIL</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $sltuser->email}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="username">USERNAME</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ $sltuser->username}}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password">PASSWORD</label><label class="text-danger">*</label>
                                    <input type="password" class="form-control" id="password" name="password" value="**************************" disabled>
                                    <small>Password must contain <strong class="text-danger">Charecters</strong> and <strong class="text-danger">Digits</strong></small>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="address">ADDRESS</label><label class="text-danger">*</label>
                            <textarea class="form-control" rows="4" id="address" name="address" disabled>{{ $sltuser->address}}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="phone">PHONE</label>
                                    <input type="text" class="form-control" id="phone" name="phone" maxlength="14" value="{{ $sltuser->phone}}" disabled>
                                </div>

                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="branch">BRANCH</label>
                                    <select class="form-control form-control-sm" name="branch" id="branch">
                                        <option value="{{ $sltbranch->id }}" selected disabled>{{ $sltbranch->name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="role">ROLE</label>
                                    <select class="form-control form-control-sm" name="role" id="role">
                                        <option value="{{ $sltrole->id }}" selected disabled>{{ $sltrole->name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="status">STATUS</label>
                                <select class="form-control form-control-sm" name="status" id="status">
                                    <option value="{{ $sltuser->status }}" selected disabled>{{ $sltuser->status }}</option>
                                </select>
                            </div>
                        </div>

                        {{-- <button type="submit" class="btn btn-dark" id="submit_button" >UPDATE</button> --}}
                        <a href="/admin/employee" class="btn btn-dark">BACK</a>

                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
