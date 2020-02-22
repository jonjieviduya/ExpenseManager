@extends('templates.master')

@section('additional-style')
    <style>
        .well{ background: #fff; }
    </style>
@stop

@section('content')
    <div class="content-wrapper" id="userContainer">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Change Password
            </h1>
			<ol class="breadcrumb">
                <li>Account Settings</li>
				<li class="active">Change Password</li>
			</ol>
        </section>

        <section class="content">
            <div class="well col-md-3">
                <form action="{{ route('changepassword') }}" method="POST">
                    <div class="form-group{{ (session()->has('password-incorrect')) ? ' has-error' : '' }}">
                        <label class="control-label">Current Password</label>
                        <input type="password" name="current_password" value="" class="form-control" required>
                        @if(session()->has('password-incorrect'))
                            <span class="help-block">{{ session()->get('password-incorrect') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ ($errors->has('new_password')) ? ' has-error' : '' }}">
                        <label class="control-label">New Password</label>
                        <input type="password" name="new_password" value="{{ old('new_password') }}" class="form-control" required>
                        @if($errors->has('new_password'))
                            <span class="help-block">{{ $errors->first('new_password') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ ($errors->has('retype_password')) ? ' has-error' : '' }}">
                        <label class="control-label">Retype Password</label>
                        <input type="password" name="retype_password" value="{{ old('retype_password') }}" class="form-control" required>
                        @if($errors->has('retype_password'))
                            <span class="help-block">{{ $errors->first('retype_password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Save Changes</button>
                    </div>

                    {{ csrf_field() }}
                </form>
            </div>
        </section>

    </div>

    
@stop