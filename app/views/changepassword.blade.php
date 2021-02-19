@extends('layout.layout')
       
@section('content')

<div class="content-wrapper">
      <div class="row grid-margin">
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
              <h3 class="card-title pb-4">Change Password</h3>
              <form class="cmxform" id="signupForm3"  method="POST" action="{{ route('changePassword') }}">
                  {{ csrf_field() }}
                  <div class="form-group{{ $errors->has('currentPassword') ? ' has-error' : '' }}">
                    <label for="currentPassword">Current Password</label>
                    <input id="currentPassword" class="form-control" name="currentPassword" type="password" required>
                    @if ($errors->has('currentPassword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('currentPassword') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('newPassword') ? ' has-error' : '' }}">
                    <label for="newPassword">New Password</label>
                    <input id="newPassword" class="form-control" name="newPassword" type="password" required>
                    @if ($errors->has('newPassword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('newPassword') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('confirmPassword') ? ' has-error' : '' }}">
                    <label for="confirmPassword">Confirm Password</label>
                    <input id="confirmPassword" class="form-control" name="confirmPassword" type="password" required>
                    @if ($errors->has('confirmPassword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('confirmPassword') }}</strong>
                        </span>
                    @endif
                  </div>
                  <button type="submit" class="btn btn-success mr-2">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
@endsection