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

                <div class="card-header bg-navy"><h3>{{ __('CREATE USER') }}</h3>
                    <a href="/branch/employee/" class="btn btn-outline-warning btn-sm float-right"><i class="fas fa-backward"></i>&nbsp;</i>BACK</a>
                </div>

                <div class="card-body">

                    <form action="{{ route('branch.employee.store') }}" method="POST">
                        {{-- <form action="{{ route('order.store') }}" method="POST"> --}}
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">NAME</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Employee Nane" required autocomplete="off" autofocus>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">EMPLOYEE EMAIL</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Employee Email" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="username">USERNAME</label><label class="text-danger">*</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autocomplete="off" autofocus>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password">PASSWORD</label><label class="text-danger">*</label>
                                    <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
                                    <small>Password must contain <strong class="text-danger">Charecters</strong> and <strong class="text-danger">Digits</strong></small>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="address">ADDRESS</label><label class="text-danger">*</label>
                            <textarea class="form-control" rows="4" id="address" name="address" placeholder="Employee Address" required autocomplete="off"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="phone">PHONE</label>
                                    <input type="text" class="form-control" id="phone" name="phone" maxlength="14" placeholder="+8801711xxxxxx" autocomplete="off">
                                </div>

                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="branch">BRANCH</label>
                                    <select class="form-control form-control-sm" name="branch" id="branch">
                                        @foreach ($branch as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="role">ROLE</label>
                                    <select class="form-control form-control-sm" name="role" id="role">
                                        @foreach ($role as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="status">STATUS</label>
                                <select class="form-control form-control-sm" name="status" id="status">
                                    <option value="ACTIVE" selected>ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark" id="submit_button" >CREATE</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
